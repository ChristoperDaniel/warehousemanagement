<?php

namespace App\Controllers;

class ProductFeatureController extends BaseController
{
    public function index() {   
        if (session()->get('num_user') == '') {
            return redirect()->to('/loginUserProduct');
        }    
        return view('product_feature');
    }
}
