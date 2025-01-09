<?php

namespace App\Models;

use CodeIgniter\Model;

class JobAssign extends Model
{
    protected $table            = 'jobs';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'name', 'email', 'category', 'product', 'status'
    ];
    protected $useTimestamps = true;
    
    public function getJob() {
        return $this->findAll();
    }

    public function updateJobAssign(string $id_job, string $status) {
        return $this->update($id_job, ['status' => $status]);
    }    
}