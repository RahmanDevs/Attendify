<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AttendifySeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // 1. SEED DEPARTMENTS
        $departments = [
            ['name' => 'Technology & Engineering', 'description' => 'Divisi pengembangan sistem dan infrastruktur IT', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Human Resources', 'description' => 'Divisi manajemen SDM dan hubungan industrial', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Finance & Accounting', 'description' => 'Divisi keuangan dan audit', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Operations', 'description' => 'Divisi operasional bisnis dan logistik', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Marketing & Sales', 'description' => 'Divisi pemasaran dan pertumbuhan bisnis', 'created_at' => $now, 'updated_at' => $now],
        ];

        foreach ($departments as $dept) {
            $existing = $this->db->table('departments')->where('name', $dept['name'])->get()->getRow();
            if (!$existing) {
                $this->db->table('departments')->insert($dept);
            }
        }

        // 2. SEED SHIFTS
        $shifts = [
            ['name' => 'Shift Reguler (Pagi)', 'start_time' => '08:00:00', 'end_time' => '17:00:00', 'late_tolerance_minutes' => 15, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Shift Siang', 'start_time' => '13:00:00', 'end_time' => '21:00:00', 'late_tolerance_minutes' => 15, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Shift Fleksibel', 'start_time' => '09:00:00', 'end_time' => '18:00:00', 'late_tolerance_minutes' => 30, 'created_at' => $now, 'updated_at' => $now],
        ];

        foreach ($shifts as $shift) {
            $existing = $this->db->table('shifts')->where('name', $shift['name'])->get()->getRow();
            if (!$existing) {
                $this->db->table('shifts')->insert($shift);
            }
        }

        // 3. SEED OFFICE LOCATIONS
        $locations = [
            [
                'name'          => 'Kantor Pusat Attendify Jakarta',
                'address'       => 'Jl. Jend. Sudirman Kav. 52-53, Senayan, Kebayoran Baru, Jakarta Selatan',
                'latitude'      => -6.22501400,
                'longitude'     => 106.80965600,
                'radius_meters' => 150,
                'is_active'     => 1,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]
        ];

        foreach ($locations as $loc) {
            $existing = $this->db->table('office_locations')->where('name', $loc['name'])->get()->getRow();
            if (!$existing) {
                $this->db->table('office_locations')->insert($loc);
            }
        }

        // 4. SEED USERS
        $users = [
            [
                'nik'           => 'ADM-001',
                'name'          => 'Administrator HRD',
                'email'         => 'admin@attendify.com',
                'password'      => password_hash('password123', PASSWORD_BCRYPT),
                'role'          => 'admin',
                'department_id' => 2,
                'shift_id'      => 1,
                'phone'         => '081234567890',
                'is_active'     => 1,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'nik'           => 'EMP-101',
                'name'          => 'Alex Pratama',
                'email'         => 'karyawan@attendify.com',
                'password'      => password_hash('password123', PASSWORD_BCRYPT),
                'role'          => 'employee',
                'department_id' => 1,
                'shift_id'      => 1,
                'phone'         => '081298765432',
                'is_active'     => 1,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'nik'           => 'EMP-102',
                'name'          => 'Siti Rahmawati',
                'email'         => 'siti@attendify.com',
                'password'      => password_hash('password123', PASSWORD_BCRYPT),
                'role'          => 'employee',
                'department_id' => 1,
                'shift_id'      => 1,
                'phone'         => '081255554444',
                'is_active'     => 1,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ];

        foreach ($users as $user) {
            $existing = $this->db->table('users')->where('email', $user['email'])->get()->getRow();
            if (!$existing) {
                $this->db->table('users')->insert($user);
            } else {
                $this->db->table('users')->where('email', $user['email'])->update([
                    'nik'           => $user['nik'],
                    'role'          => $user['role'],
                    'department_id' => $user['department_id'],
                    'shift_id'      => $user['shift_id'],
                    'phone'         => $user['phone'],
                    'is_active'     => 1,
                    'password'      => $user['password'],
                ]);
            }
        }
    }
}
