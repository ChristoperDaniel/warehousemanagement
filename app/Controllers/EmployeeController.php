<?php

namespace App\Controllers;

use App\Models\Employee;

class EmployeeController extends BaseController
{
    public function index()
    {
        $username = session()->get('username');
        $role = session()->get('role');

        if (!$username || ($role !== 'Admin' && $role !== 'Manager')) {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }
        $model = new Employee();
        $data['employee'] = $model->getDataEmployee();
        return view('employee', $data);
    }

    public function getDataEmployeeOnly(){
        $model = new Employee();
        $data['employee'] = $model->getDataEmployee();
        return $this->response->setJSON($data);
    }

    public function inputDataEmployee()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $department = $this->request->getPost('department');
        $status = $this->request->getPost('status');
        $hire_date = $this->request->getPost('hire_date');
        $role = $this->request->getPost('role');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Invalid email format');
        }
        
        $model = new Employee();
        $existingEmployee = $model->where('email', $email)->first();

        if ($existingEmployee) {
            return redirect()->back()->with('error', 'Email already exists');
        }

        try {
            $model->addEmployee([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'department' => $department,
                'status' => $status,
                'hire_date' => $hire_date,
                'role' => $role,
            ]);

            return redirect()->to('/employee')->with('message', 'Employee added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add employee: ' . $e->getMessage());
        }
    }

    public function updateEmployee()
    {
        $model = new Employee();
        $id_employee = $this->request->getPost('id_employee');
        $status = $this->request->getPost('updateStatus');

        if ($id_employee && $status) {
            if ($model->updateDataEmployee($id_employee, $status)) {
                return redirect()->to('/employee')->with('message', 'Data berhasil diupdate');
            }
            else {
                return redirect()->to('/employee')->with('error', 'Data gagal diupdate');
            }
        }
        else {
            return redirect()->to('/employee')->with('error', 'Tidak ada data yang dipilih');
        }
    }

    public function deleteEmployee()
    {
        $model = new Employee();
        $id_employee = $this->request->getPost('id');

        if ($id_employee) {
            if ($model->deleteDataEmployee($id_employee)) {
                return redirect()->to('/employee')->with('message', 'Data berhasil dihapus');
            }
            else {
                return redirect()->to('/employee')->with('error', 'Data gagal dihapus');
            }
        }
        else {
            return redirect()->to('/employee')->with('error', 'Tidak ada data yang dipilih');
        }
    }

}
