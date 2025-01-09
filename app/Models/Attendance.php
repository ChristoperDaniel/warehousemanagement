<?php

namespace App\Models;

use CodeIgniter\Model;

class Attendance extends Model
{
    protected $table            = 'attendance';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'name', 'email', 'department', 'status'
    ];
    protected $useTimestamps = true;
    
    public function getAttendance() {
        return $this->findAll();
    }

    public function add($input) {
        return $this->insert($input);
    }  

    public function getStatusByEmail($email) {
        $user = $this->where('email', $email)->first();
        return $user ? $user['status'] : null;
    }
}