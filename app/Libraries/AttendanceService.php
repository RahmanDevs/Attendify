<?php

namespace App\Libraries;

use App\Models\AttendanceModel;
use App\Models\ShiftModel;
use App\Models\UserModel;
use App\Models\OfficeLocationModel;
use App\Models\FaceBiometricModel;

class AttendanceService
{
    protected AttendanceModel $attendanceModel;
    protected ShiftModel $shiftModel;
    protected UserModel $userModel;
    protected OfficeLocationModel $officeModel;
    protected FaceBiometricModel $biometricModel;

    public function __construct()
    {
        $this->attendanceModel = new AttendanceModel();
        $this->shiftModel      = new ShiftModel();
        $this->userModel       = new UserModel();
        $this->officeModel     = new OfficeLocationModel();
        $this->biometricModel  = new FaceBiometricModel();
    }

    /**
     * Process Clock-In
     */
    public function processClockIn(int $userId, array $payload): array
    {
        $today = date('Y-m-d');
        $nowTime = date('H:i:s');

        // Check if already checked in today
        $existing = $this->attendanceModel->getAttendanceOnDate($userId, $today);
        if ($existing && !empty($existing['clock_in'])) {
            return [
                'success' => false,
                'message' => 'Anda sudah melakukan presensi masuk hari ini pada pukul ' . substr($existing['clock_in'], 0, 5),
            ];
        }

        // Get User & Shift details
        $user = $this->userModel->getUserWithDetails($userId);
        $shiftStart = $user['start_time'] ?? '08:00:00';
        $lateTolerance = (int)($user['late_tolerance_minutes'] ?? 15);

        // Determine on-time or late
        $shiftStartTimestamp = strtotime("$today $shiftStart");
        $toleranceTimestamp  = $shiftStartTimestamp + ($lateTolerance * 60);
        $nowTimestamp        = strtotime("$today $nowTime");

        $status = ($nowTimestamp > $toleranceTimestamp) ? 'late' : 'present';

        // Validate Geofence if location provided
        $office = $this->officeModel->where('is_active', 1)->first();
        $distanceMeters = null;
        if ($office && !empty($payload['latitude']) && !empty($payload['longitude'])) {
            $geofenceCheck = GeofenceService::validateLocation(
                (float)$payload['latitude'],
                (float)$payload['longitude'],
                (float)$office['latitude'],
                (float)$office['longitude'],
                (int)$office['radius_meters']
            );
            $distanceMeters = (int)$geofenceCheck['distance'];

            if (!$geofenceCheck['is_valid']) {
                return [
                    'success' => false,
                    'message' => $geofenceCheck['message'],
                    'distance' => $distanceMeters,
                ];
            }
        }

        // Validate Biometric Face if descriptor provided
        $matchScore = 95.0; // default acceptable confidence if test/enroll
        $storedBiometric = $this->biometricModel->where('user_id', $userId)->where('is_primary', 1)->first();
        if ($storedBiometric && !empty($payload['descriptor'])) {
            $bioResult = BiometricService::verifyFace($payload['descriptor'], $storedBiometric['descriptor']);
            if (!$bioResult['is_match']) {
                return [
                    'success' => false,
                    'message' => 'Verifikasi biometrik gagal! Wajah tidak cocok dengan data Anda (Kemiripan: ' . $bioResult['match_score'] . '%).',
                    'match_score' => $bioResult['match_score'],
                ];
            }
            $matchScore = $bioResult['match_score'];
        }

        // Save Photo Snapshot if base64 provided
        $photoPath = $this->saveBase64Photo($payload['photo'] ?? null, 'in_' . $userId . '_' . time());

        // Save Attendance
        $attendanceData = [
            'user_id'            => $userId,
            'attendance_date'    => $today,
            'clock_in'           => $nowTime,
            'in_latitude'        => $payload['latitude'] ?? null,
            'in_longitude'       => $payload['longitude'] ?? null,
            'in_distance_meters' => $distanceMeters,
            'in_photo'           => $photoPath,
            'match_score'        => $matchScore,
            'status'             => $status,
            'notes'              => $payload['notes'] ?? ($status === 'late' ? 'Terlambat masuk kerja' : 'Presensi tepat waktu'),
        ];

        if ($existing) {
            $this->attendanceModel->update($existing['id'], $attendanceData);
        } else {
            $this->attendanceModel->insert($attendanceData);
        }

        return [
            'success'     => true,
            'message'     => $status === 'late'
                ? "Presensi Masuk Berhasil dicatat (Terlambat pada pukul {$nowTime})"
                : "Presensi Masuk Berhasil dicatat tepat waktu pada pukul {$nowTime}!",
            'status'      => $status,
            'clock_in'    => $nowTime,
            'match_score' => $matchScore,
            'distance'    => $distanceMeters,
        ];
    }

    /**
     * Process Clock-Out
     */
    public function processClockOut(int $userId, array $payload): array
    {
        $today = date('Y-m-d');
        $nowTime = date('H:i:s');

        $existing = $this->attendanceModel->getAttendanceOnDate($userId, $today);
        if (!$existing || empty($existing['clock_in'])) {
            return [
                'success' => false,
                'message' => 'Anda belum melakukan presensi masuk hari ini!',
            ];
        }

        if (!empty($existing['clock_out'])) {
            return [
                'success' => false,
                'message' => 'Anda sudah melakukan presensi pulang hari ini pada pukul ' . substr($existing['clock_out'], 0, 5),
            ];
        }

        // Validate Geofence if location provided
        $office = $this->officeModel->where('is_active', 1)->first();
        $distanceMeters = null;
        if ($office && !empty($payload['latitude']) && !empty($payload['longitude'])) {
            $geofenceCheck = GeofenceService::validateLocation(
                (float)$payload['latitude'],
                (float)$payload['longitude'],
                (float)$office['latitude'],
                (float)$office['longitude'],
                (int)$office['radius_meters']
            );
            $distanceMeters = (int)$geofenceCheck['distance'];

            if (!$geofenceCheck['is_valid']) {
                return [
                    'success' => false,
                    'message' => $geofenceCheck['message'],
                    'distance' => $distanceMeters,
                ];
            }
        }

        // Save Photo Snapshot if base64 provided
        $photoPath = $this->saveBase64Photo($payload['photo'] ?? null, 'out_' . $userId . '_' . time());

        $this->attendanceModel->update($existing['id'], [
            'clock_out'           => $nowTime,
            'out_latitude'        => $payload['latitude'] ?? null,
            'out_longitude'       => $payload['longitude'] ?? null,
            'out_distance_meters' => $distanceMeters,
            'out_photo'           => $photoPath,
        ]);

        return [
            'success'   => true,
            'message'   => "Presensi Pulang Berhasil dicatat pada pukul {$nowTime}!",
            'clock_out' => $nowTime,
            'distance'  => $distanceMeters,
        ];
    }

    /**
     * Helper to save base64 image string to public uploads folder
     */
    protected function saveBase64Photo(?string $base64Data, string $filenamePrefix): ?string
    {
        if (empty($base64Data)) {
            return null;
        }

        // Match data:image/(png|jpeg|jpg);base64,
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
            $data = substr($base64Data, strpos($base64Data, ',') + 1);
            $data = base64_decode($data);
            if ($data === false) {
                return null;
            }

            $ext = strtolower($type[1]);
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $ext = 'jpg';
            }

            $uploadDir = FCPATH . 'uploads/attendances/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0755, true);
            }

            $fileName = $filenamePrefix . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            file_put_contents($uploadDir . $fileName, $data);

            return 'uploads/attendances/' . $fileName;
        }

        return null;
    }
}
