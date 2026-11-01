<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nik',
        'name',
        'email',
        'password',
        'role',
        'role_id',
        'department_id',
        'shift_id',
        'phone',
        'avatar',
        'is_active',
        'created_at',
        'updated_at',
        'update_at'
    ];

    // Automatic timestamps
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $beforeInsert  = ['hashPassword'];
    protected $beforeUpdate  = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!empty($data['data']['password'])) {
            // Only hash if not already hashed
            $info = password_get_info($data['data']['password']);
            if ($info['algo'] === 0) {
                $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
            }
        }
        return $data;
    }

    /**
     * Get user with department and shift details
     */
    public function getUserWithDetails(int $id)
    {
        return $this->select('users.*, departments.name as department_name, shifts.name as shift_name, shifts.start_time, shifts.end_time, shifts.late_tolerance_minutes')
            ->join('departments', 'departments.id = users.department_id', 'left')
            ->join('shifts', 'shifts.id = users.shift_id', 'left')
            ->where('users.id', $id)
            ->first();
    }
}
