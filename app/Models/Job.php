<?php

namespace App\Models;

use CodeIgniter\Model;

class Job extends Model
{
    protected $table            = 'job';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'name', 'email', 'category', 'product', 'status'
    ];
    protected $useTimestamps = true;
    
    public function getJob() {
        return $this->findAll();
    }

    public function addJob($input) {
        return $this->insert($input);
    }

    public function deleteJob(String $id_job) {
        return $this->delete($id_job);
    }

    public function updateJob(string $id_job, string $product, string $status) {
        return $this->update($id_job, [
            'product' => $product,
            'status' => $status,
        ]);
    }    
}