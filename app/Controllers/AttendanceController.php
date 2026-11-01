<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AttendanceModel;
use App\Models\OfficeLocationModel;
use App\Models\FaceBiometricModel;
use App\Libraries\AttendanceService;

class AttendanceController extends BaseController
{
    protected UserModel $userModel;
    protected AttendanceModel $attendanceModel;
    protected OfficeLocationModel $officeModel;
    protected FaceBiometricModel $biometricModel;
    protected AttendanceService $attendanceService;

    public function __construct()
    {
        $this->userModel         = new UserModel();
        $this->attendanceModel   = new AttendanceModel();
        $this->officeModel       = new OfficeLocationModel();
        $this->biometricModel    = new FaceBiometricModel();
        $this->attendanceService = new AttendanceService();
    }

    /**
     * Live Face Recognition & Geofencing Scan Page
     */
    public function scan()
    {
        $userId = (int)session()->get('user_id');
        $user = $this->userModel->getUserWithDetails($userId);

        $today = date('Y-m-d');
        $todayAttendance = $this->attendanceModel->getAttendanceOnDate($userId, $today);

        // Active Office Geofence configuration
        $office = $this->officeModel->where('is_active', 1)->first() ?? [
            'name'          => 'Kantor Pusat Attendify Jakarta',
            'latitude'      => -6.22501400,
            'longitude'     => 106.80965600,
            'radius_meters' => 150,
        ];

        // Check if user has enrolled face biometrics
        $hasEnrolledFace = $this->biometricModel->where('user_id', $userId)->countAllResults() > 0;

        $data = [
            'title'           => 'Presensi AI Face Recognition | Attendify',
            'user'            => $user,
            'todayAttendance' => $todayAttendance,
            'office'          => $office,
            'hasEnrolledFace' => $hasEnrolledFace,
            'canClockIn'      => empty($todayAttendance['clock_in']),
            'canClockOut'     => !empty($todayAttendance['clock_in']) && empty($todayAttendance['clock_out']),
        ];

        return view('attendance/scan', $data);
    }

    /**
     * User Attendance History Page
     */
    public function history()
    {
        $userId = (int)session()->get('user_id');
        $user = $this->userModel->getUserWithDetails($userId);

        $selectedMonth = $this->request->getGet('month') ?: date('Y-m');
        $attendances = $this->attendanceModel->getUserMonthlyHistory($userId, $selectedMonth);

        $data = [
            'title'         => 'Riwayat Presensi | Attendify',
            'user'          => $user,
            'attendances'   => $attendances,
            'selectedMonth' => $selectedMonth,
        ];

        return view('attendance/history', $data);
    }

    /**
     * Face Biometric Enrollment View
     */
    public function faceEnrollment()
    {
        $userId = (int)session()->get('user_id');
        $user = $this->userModel->getUserWithDetails($userId);
        $enrolled = $this->biometricModel->where('user_id', $userId)->where('is_primary', 1)->first();

        $data = [
            'title'    => 'Pendaftaran Biometrik Wajah | Attendify',
            'user'     => $user,
            'enrolled' => $enrolled,
        ];

        return view('employee/face_enrollment', $data);
    }

    /**
     * API Endpoint: Process Attendance (Clock-In / Clock-Out)
     */
    public function apiSubmitAttendance()
    {
        $userId = (int)session()->get('user_id');
        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Sesi login tidak sah atau telah berakhir.',
            ]);
        }

        $type = $this->request->getPost('type') ?? 'clock_in';
        $payload = [
            'latitude'   => $this->request->getPost('latitude'),
            'longitude'  => $this->request->getPost('longitude'),
            'photo'      => $this->request->getPost('photo'),
            'descriptor' => $this->request->getPost('descriptor'),
            'notes'      => $this->request->getPost('notes'),
        ];

        if ($type === 'clock_out') {
            $result = $this->attendanceService->processClockOut($userId, $payload);
        } else {
            $result = $this->attendanceService->processClockIn($userId, $payload);
        }

        return $this->response->setJSON($result);
    }

    /**
     * API Endpoint: Save Enrolled Face Descriptor
     */
    public function apiEnrollFace()
    {
        $userId = (int)session()->get('user_id');
        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Sesi login tidak sah.',
            ]);
        }

        $descriptor = $this->request->getPost('descriptor');
        $photoBase64 = $this->request->getPost('photo');

        if (empty($descriptor)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Data deskriptor wajah tidak boleh kosong.',
            ]);
        }

        // Save photo
        $photoPath = null;
        if (!empty($photoBase64) && preg_match('/^data:image\/(\w+);base64,/', $photoBase64)) {
            $data = substr($photoBase64, strpos($photoBase64, ',') + 1);
            $data = base64_decode($data);
            if ($data !== false) {
                $uploadDir = FCPATH . 'uploads/faces/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0755, true);
                }
                $fileName = 'face_' . $userId . '_' . time() . '.jpg';
                file_put_contents($uploadDir . $fileName, $data);
                $photoPath = 'uploads/faces/' . $fileName;

                // Also update user's avatar
                $this->userModel->update($userId, ['avatar' => $photoPath]);
            }
        }

        // Deactivate old biometrics
        $this->biometricModel->where('user_id', $userId)->set(['is_primary' => 0])->update();

        // Save new biometric
        $this->biometricModel->insert([
            'user_id'      => $userId,
            'descriptor'   => is_array($descriptor) ? json_encode($descriptor) : $descriptor,
            'sample_photo' => $photoPath,
            'is_primary'   => 1,
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Biometrik wajah berhasil didaftarkan dan diverifikasi!',
            'photo'   => $photoPath ? base_url($photoPath) : null,
        ]);
    }
}
