<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AttendanceModel;
use App\Models\LeaveRequestModel;
use App\Models\DepartmentModel;

class AdminController extends BaseController
{
    protected UserModel $userModel;
    protected AttendanceModel $attendanceModel;
    protected LeaveRequestModel $leaveModel;
    protected DepartmentModel $departmentModel;

    public function __construct()
    {
        $this->userModel       = new UserModel();
        $this->attendanceModel = new AttendanceModel();
        $this->leaveModel      = new LeaveRequestModel();
        $this->departmentModel = new DepartmentModel();
    }

    /**
     * Admin / HR Executive Dashboard
     */
    public function dashboard()
    {
        $today = date('Y-m-d');

        // Total active employees
        $totalEmployees = $this->userModel->where('role', 'employee')->where('is_active', 1)->countAllResults();

        // Today's attendance metrics
        $metrics = $this->attendanceModel->getTodayMetrics($today);
        $totalPresent = $metrics['present'];
        $totalLate    = $metrics['late'];
        $totalOnTime  = $metrics['on_time'];

        // Pending leaves
        $pendingLeaves = $this->leaveModel->getPendingCount();

        // Attendance rate percentage
        $attendanceRate = $totalEmployees > 0 ? round(($totalPresent / $totalEmployees) * 100, 1) : 0;

        // Recent live attendance feed
        $recentFeed = $this->attendanceModel->getRecentFeed(8);

        $data = [
            'title'          => 'Dashboard HR & Eksekutif | Attendify',
            'totalEmployees' => $totalEmployees,
            'totalPresent'   => $totalPresent,
            'totalLate'      => $totalLate,
            'totalOnTime'    => $totalOnTime,
            'pendingLeaves'  => $pendingLeaves,
            'attendanceRate' => $attendanceRate,
            'recentFeed'     => $recentFeed,
            'todayFormatted' => date('d F Y'),
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * Live Monitoring Feed Page
     */
    public function liveFeed()
    {
        $feed = $this->attendanceModel->getRecentFeed(25);

        $data = [
            'title' => 'Live Feed Presensi Karyawan | Attendify',
            'feed'  => $feed,
        ];

        return view('admin/attendance/live', $data);
    }

    /**
     * Attendance Report & Analytics
     */
    public function reports()
    {
        $startDate = $this->request->getGet('start_date') ?: date('Y-m-01');
        $endDate   = $this->request->getGet('end_date') ?: date('Y-m-t');
        $deptId    = $this->request->getGet('department_id');

        $builder = $this->attendanceModel
            ->select('attendances.*, users.name as user_name, users.nik, departments.name as department_name, shifts.name as shift_name')
            ->join('users', 'users.id = attendances.user_id')
            ->join('departments', 'departments.id = users.department_id', 'left')
            ->join('shifts', 'shifts.id = users.shift_id', 'left')
            ->where('attendances.attendance_date >=', $startDate)
            ->where('attendances.attendance_date <=', $endDate)
            ->orderBy('attendances.attendance_date', 'DESC');

        if (!empty($deptId)) {
            $builder->where('users.department_id', $deptId);
        }

        $records = $builder->findAll();
        $departments = $this->departmentModel->findAll();

        $data = [
            'title'       => 'Laporan & Rekapitulasi Presensi | Attendify',
            'records'     => $records,
            'departments' => $departments,
            'startDate'   => $startDate,
            'endDate'     => $endDate,
            'selectedDept'=> $deptId,
        ];

        return view('admin/reports/index', $data);
    }
}
