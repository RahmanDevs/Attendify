<?php

namespace App\Models;

use CodeIgniter\Model;

class OfficeLocationModel extends Model
{
    protected $table            = 'office_locations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'address', 'latitude', 'longitude', 'radius_meters', 'is_active', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;
}
