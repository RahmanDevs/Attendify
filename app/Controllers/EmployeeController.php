<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AttendanceModel;
use App\Models\LeaveRequestModel;
use App\Models\DepartmentModel;

class EmployeeController extends BaseController
{
    protected UserModel $userModel;
    protected AttendanceModel $attendanceModel;
    protected LeaveRequestModel $leaveModel;

    public function __construct()
    {
        $this->userModel       = new UserModel();
        $this->attendanceModel = new AttendanceModel();
        $this->leaveModel      = new LeaveRequestModel();
    }

    /**
     * Employee Main Dashboard
     */
    public function dashboard()
    {
        $userId = (int)session()->get('user_id');
        $user = $this->userModel->getUserWithDetails($userId);

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Sesi berakhir, silakan login kembali.');
        }

        $today = date('Y-m-d');
        $currentMonth = date('Y-m');

        // Today's attendance
        $todayAttendance = $this->attendanceModel->getAttendanceOnDate($userId, $today);

        // Monthly statistics
        $monthlyRecords = $this->attendanceModel->getUserMonthlyHistory($userId, $currentMonth);
        $totalPresent = 0;
        $totalLate = 0;
        foreach ($monthlyRecords as $rec) {
            if (!empty($rec['clock_in'])) {
                $totalPresent++;
            }
            if ($rec['status'] === 'late') {
                $totalLate++;
            }
        }

        // Leave Requests
        $recentLeaves = $this->leaveModel->getUserRequests($userId);

        $data = [
            'title'           => 'Dashboard Karyawan | Attendify',
            'user'            => $user,
            'todayAttendance' => $todayAttendance,
            'totalPresent'    => $totalPresent,
            'totalLate'       => $totalLate,
            'recentLeaves'    => array_slice($recentLeaves, 0, 5),
            'todayDateFormatted' => date('d F Y'),
        ];

        return view('employee/dashboard', $data);
    }

    /**
     * Employee Profile & Password Change
     */
    public function profile()
    {
        $userId = (int)session()->get('user_id');
        $user = $this->userModel->getUserWithDetails($userId);

        $data = [
            'title' => 'Profil Saya | Attendify',
            'user'  => $user,
        ];

        return view('employee/profile', $data);
    }

    /**
     * Update Profile Action
     */
    public function updateProfile()
    {
        $userId = (int)session()->get('user_id');

        $rules = [
            'name'  => 'required|min_length[3]|max_length[100]',
            'phone' => 'permit_empty|min_length[8]|max_length[20]',
        ];

        $newPassword = $this->request->getPost('new_password');
        if (!empty($newPassword)) {
            $rules['old_password'] = 'required';
            $rules['new_password'] = 'min_length[8]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $this->userModel->find($userId);

        $updateData = [
            'name'  => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
        ];

        if (!empty($newPassword)) {
            if (!password_verify($this->request->getPost('old_password'), $user['password'])) {
                return redirect()->back()->withInput()->with('error', 'Kata sandi saat ini tidak sesuai!');
            }
            $updateData['password'] = $newPassword; // will be hashed by UserModel beforeUpdate
        }

        $this->userModel->update($userId, $updateData);
        session()->set('name', $updateData['name']);

        return redirect()->to('/employee/profile')->with('success', 'Profil Anda berhasil diperbarui!');
    }

    /**
     * Employee Leaves & Permits Page
     */
    public function leaves()
    {
        $userId = (int)session()->get('user_id');
        $user = $this->userModel->find($userId);
        $leaves = $this->leaveModel->getUserRequests($userId);

        $data = [
            'title'  => 'Pengajuan Izin & Cuti | Attendify',
            'user'   => $user,
            'leaves' => $leaves,
        ];

        return view('employee/leaves', $data);
    }

    /**
     * Process Leave Request
     */
    public function submitLeave()
    {
        $userId = (int)session()->get('user_id');

        $rules = [
            'type'       => 'required|in_list[leave,sick,permit,overtime]',
            'start_date' => 'required|valid_date',
            'end_date'   => 'required|valid_date',
            'reason'     => 'required|min_length[5]',
            'attachment' => 'permit_empty|uploaded[attachment]|max_size[attachment,2048]|ext_in[attachment,pdf,jpg,jpeg,png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $attachmentPath = null;
        $file = $this->request->getFile('attachment');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/attachments/', $newName);
            $attachmentPath = 'uploads/attachments/' . $newName;
        }

        $this->leaveModel->save([
            'user_id'         => $userId,
            'type'            => $this->request->getPost('type'),
            'start_date'      => $this->request->getPost('start_date'),
            'end_date'        => $this->request->getPost('end_date'),
            'reason'          => $this->request->getPost('reason'),
            'attachment_path' => $attachmentPath,
            'status'          => 'pending',
        ]);

        return redirect()->to('/employee/leaves')->with('success', 'Permohonan izin berhasil diajukan dan sedang menunggu persetujuan HR.');
    }
}
