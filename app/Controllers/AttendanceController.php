<?php

namespace App\Controllers;

use App\Models\Attendance;

class AttendanceController extends BaseController
{
    public function index()
    {
        $username = session()->get('username');

        if (!$username) {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }

        $model = new Attendance();
        $data['attendance'] = $model->getAttendance();
        return view('attendance', $data);
    }

    public function inputAttendance()
    {
        $email = $this->request->getPost('email');
        $name = $this->request->getPost('name');
        $status = $this->request->getPost('status');
        $department = $this->request->getPost('department');

        $model = new Attendance();

        // Jika validasi berhasil, masukkan data ke database
        try {
            $model->add([
                'name' => $name,
                'email' => $email,
                'department' => $department,
                'status' => $status,
            ]);

            // Redirect kembali ke halaman utama dengan pesan sukses
            return redirect()->to('/attendance')->with('message', 'Job added successfully');
        } catch (\Exception $e) {
            // Tangani jika terjadi error saat penyimpanan data
            return redirect()->back()->with('error', 'Failed to add job: ' . $e->getMessage());
        }
    }
}
