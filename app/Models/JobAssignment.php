<?php

namespace App\Models;

use CodeIgniter\Model;

class JobAssignment extends Model
{
    protected $table            = 'job_assignments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'employee_id', 'job_title', 'start_date', 
        'description', 'status'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'employee_id' => 'required|numeric',
        'job_title'   => 'required',
        'start_date'  => 'required|valid_date',
        'status'      => 'required'
    ];
}