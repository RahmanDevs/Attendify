<?php

namespace App\Models;

use CodeIgniter\Model;

class ShiftModel extends Model
{
    protected $table            = 'shifts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'start_time', 'end_time', 'late_tolerance_minutes', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;
}
