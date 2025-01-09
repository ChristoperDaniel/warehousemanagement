<?php
namespace App\Controllers;
use App\Models\Login;
class LoginController extends BaseController {

    public function index()
    {
        return view('login');
    }

    public function login_action()
    {
        $model = model(Login::class);
        $username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));

        $cek = $model->getDataUsers($username, $password);

        if ($cek) {
            session()->set([
                'username' => $username,
                'role' => $cek->role,
            ]);
            
            if ($cek->role == "Staff") {
                return redirect()->to('/staff');
            } else if ($cek->role == "Manager" || $cek->role == "Admin"){
                return redirect()->to('/dashboard');
            }
        } else {
            return redirect()->to('/login')->with('error', 'Wrong username or password');
        }
    }

    public function logout() 
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}