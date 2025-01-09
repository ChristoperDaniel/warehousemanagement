<?php

namespace App\Controllers;

use App\Models\JobAssign;

class JobAssignController extends BaseController
{
    public function index()
    {
        $username = session()->get('username');
        $role = session()->get('role');

        if (!$username || $role !== 'Staff') {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }

        $model = new JobAssign();
        $data['job_assign'] = $model->getJob();
        return view('job_assign', $data);
    }

    public function updateJobAssign()
    {
        $model = new JobAssign();
        $id_job = $this->request->getPost('id_job');
        $status = $this->request->getPost('updateStatus');

        if ($id_job && $status) {
            if ($model->updateJobAssign($id_job, $status)) {
                return redirect()->to('/job_assign')->with('message', 'Data berhasil diupdate');
            }
            else {
                return redirect()->to('/job_assign')->with('error', 'Data gagal diupdate');
            }
        }
        else {
            return redirect()->to('/job_assign')->with('error', 'Tidak ada data yang dipilih');
        }
    }
}
