<?php

namespace App\Controllers;

use App\Models\Employee;

class EmployeeController extends BaseController
{
    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/login');
        }
        $model = new Employee();
        $data['employee'] = $model->getDataEmployee();
        return view('employee', $data);
    }

    public function getDataEmployeeOnly(){
        $model = new Employee();
        $data['employee'] = $model->getDataEmployee();
    }

    public function inputDataEmployee()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $department = $this->request->getPost('department');
        $status = $this->request->getPost('status');
        $hire_date = $this->request->getPost('hire_date');
        $job_title = $this->request->getPost('job_title');

        $model = new Employee();
        $model->addEmployee([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'department' => $department,
            'status' => $status,
            'hire_date' => $hire_date,
            'job_title' => $job_title,
        ]);

        // Redirect kembali ke halaman utama
        return redirect()->to('/employee');
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
