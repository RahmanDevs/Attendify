<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table            = 'attendances';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id',
        'attendance_date',
        'clock_in',
        'clock_out',
        'in_latitude',
        'in_longitude',
        'in_distance_meters',
        'in_photo',
        'out_latitude',
        'out_longitude',
        'out_distance_meters',
        'out_photo',
        'match_score',
        'status',
        'notes',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps    = true;

    /**
     * Get attendance record for a specific user on a specific date
     */
    public function getAttendanceOnDate(int $userId, string $date)
    {
        return $this->where('user_id', $userId)
            ->where('attendance_date', $date)
            ->first();
    }

    /**
     * Get attendance history for a user in a given month (YYYY-MM)
     */
    public function getUserMonthlyHistory(int $userId, string $yearMonth)
    {
        return $this->where('user_id', $userId)
            ->like('attendance_date', $yearMonth, 'after')
            ->orderBy('attendance_date', 'DESC')
            ->findAll();
    }

    /**
     * Get real-time attendance feed with user and department info
     */
    public function getRecentFeed(int $limit = 10)
    {
        return $this->select('attendances.*, users.name as user_name, users.nik, users.avatar, departments.name as department_name')
            ->join('users', 'users.id = attendances.user_id')
            ->join('departments', 'departments.id = users.department_id', 'left')
            ->orderBy('attendances.attendance_date', 'DESC')
            ->orderBy('attendances.updated_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get today's attendance metrics
     */
    public function getTodayMetrics(string $today)
    {
        $totalPresent = $this->where('attendance_date', $today)->where('clock_in IS NOT NULL')->countAllResults();
        $totalLate = $this->where('attendance_date', $today)->where('status', 'late')->countAllResults();
        $totalOnTime = $this->where('attendance_date', $today)->where('status', 'present')->countAllResults();

        return [
            'present' => $totalPresent,
            'late'    => $totalLate,
            'on_time' => $totalOnTime,
        ];
    }
}
