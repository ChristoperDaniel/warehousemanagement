<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index() {       
        $username = session()->get('username');
        $role = session()->get('role');

        if (!$username || ($role !== 'Admin' && $role !== 'Manager')) {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }
        return view('dashboard');
    }
}
