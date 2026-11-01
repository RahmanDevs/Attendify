<?php

namespace App\Models;

use CodeIgniter\Model;

class FaceBiometricModel extends Model
{
    protected $table            = 'face_biometrics';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'descriptor', 'sample_photo', 'is_primary', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;
}
