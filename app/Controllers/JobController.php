<?php

namespace App\Controllers;

use App\Models\Job;
use App\Models\Employee;

class JobController extends BaseController
{
    public function index()
    {
        $username = session()->get('username');
        $role = session()->get('role');

        if (!$username || ($role !== 'Admin' && $role !== 'Manager')) {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }

        $model = new Job();
        $data['job'] = $model->getJob();
        return view('job', $data);
    }

    public function getJobOnly(){
        $model = new Job();
        $data['job'] = $model->getJob();
    }

    public function inputJob()
    {
        $email = $this->request->getPost('email');
        $name = $this->request->getPost('name');
        $product = $this->request->getPost('product');
        $status = $this->request->getPost('status');
        
        $employeeModel = new Employee();
        $category = $employeeModel->getEmployeeByEmail($email);

        if (!$category) {
            return redirect()->back()->with('error', 'Department not found for this user');
        }

        $model = new Job();

        try {
            $model->addJob([
                'name' => $name,
                'category' => $category,
                'product' => $product,
                'email' => $email,
                'status' => $status,
            ]);

            return redirect()->to('/job')->with('message', 'Job added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add job: ' . $e->getMessage());
        }
    }

    public function updateJob()
    {
        $model = new Job();
        $id_job = $this->request->getPost('id_job');
        $product = $this->request->getPost('updateProduct');
        $status = $this->request->getPost('updateStatus');

        if ($id_job && $product && $status) {
            if ($model->updateJob($id_job, $product, $status)) {
                return redirect()->to('/job')->with('message', 'Data berhasil diupdate');
            }
            else {
                return redirect()->to('/job')->with('error', 'Data gagal diupdate');
            }
        }
        else {
            return redirect()->to('/job')->with('error', 'Tidak ada data yang dipilih');
        }
    }

    public function deleteJob()
    {
        $model = new Job();
        $id_job = $this->request->getPost('id');

        if ($id_job) {
            if ($model->deleteJob($id_job)) {
                return redirect()->to('/job')->with('message', 'Data berhasil dihapus');
            }
            else {
                return redirect()->to('/job')->with('error', 'Data gagal dihapus');
            }
        }
        else {
            return redirect()->to('/job')->with('error', 'Tidak ada data yang dipilih');
        }
    }

}
