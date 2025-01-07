<?php

namespace App\Models;

use CodeIgniter\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'email', 'phone', 'department', 'status', 'hire_date', 'job_title', 
    ];
    protected $useTimestamps = true; // Untuk created_at dan updated_at otomatis

    public function getDataEmployee() {
        return $this->findAll();
    }

    public function addEmployee($input) {
        return $this-> insert($input);
    }

    public function deleteDataEmployee(array $id_employee) {
        return $this->delete($id_employee);
    }

    public function updateDataEmployee(array $id_employee, String $status) {
        return $this->whereIn('id', $id_employee)
                    ->set(['status' => $status])
                    ->update();
    }
}
