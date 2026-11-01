<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaveRequestModel extends Model
{
    protected $table            = 'leave_requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id',
        'type',
        'start_date',
        'end_date',
        'reason',
        'attachment_path',
        'status',
        'approved_by',
        'admin_notes',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps    = true;

    /**
     * Get user's own requests
     */
    public function getUserRequests(int $userId)
    {
        return $this->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Get all requests with employee details for HR
     */
    public function getAllWithDetails(?string $status = null)
    {
        $builder = $this->select('leave_requests.*, users.name as user_name, users.nik, departments.name as department_name, approver.name as approver_name')
            ->join('users', 'users.id = leave_requests.user_id')
            ->join('departments', 'departments.id = users.department_id', 'left')
            ->join('users as approver', 'approver.id = leave_requests.approved_by', 'left')
            ->orderBy('leave_requests.created_at', 'DESC');

        if (!empty($status)) {
            $builder->where('leave_requests.status', $status);
        }

        return $builder->findAll();
    }

    /**
     * Count pending requests
     */
    public function getPendingCount(): int
    {
        return $this->where('status', 'pending')->countAllResults();
    }
}
