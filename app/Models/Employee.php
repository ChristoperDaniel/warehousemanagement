<?php

namespace App\Models;

use CodeIgniter\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'email', 'phone', 'department', 'status', 'hire_date', 'role', 
    ];
    protected $useTimestamps = true;

    public function getDataEmployee() {
        return $this->findAll();
    }

    public function addEmployee($input) {
        return $this-> insert($input);
    }

    public function deleteDataEmployee(String $id_employee) {
        return $this->delete($id_employee);
    }

    public function updateDataEmployee(String $id_employee, String $status) {
        return $this->update($id_employee, ['status' => $status]);
    }

    public function getEmployeeByEmail($email) {
        $user = $this->where('email', $email)->first();
        return $user ? $user['department'] : null;
    }
}
