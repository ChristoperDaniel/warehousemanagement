<?php
namespace App\Controllers;
use App\Models\LoginProduct;

class LoginProductController extends BaseController{
    public function index(){
        return view('loginproduct');
    }
    public function login_action_user(){
        $model = model(LoginProduct::class);
        $email = $this->request->getPost('email');
        $password = md5($this->request->getPost('password'));
        $cek = $model->getDataUserProduct($email, $password);
        if ($cek == 1){
            session()->set('num_user', $cek);
            return redirect()->to('/productFeature');
        } else {
            return redirect()->to('/loginUserProduct');
        }
    }           
    public function logout() {
        session()->destroy();
        return redirect()->to('/loginUserProduct');
    }
}
