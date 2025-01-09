<?php

namespace App\Controllers;

class Staff extends BaseController
{
    public function index() {       
        $username = session()->get('username');
        $role = session()->get('role');

        if (!$username || $role !== 'Staff') {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }
        return view('staff');
    }
}
