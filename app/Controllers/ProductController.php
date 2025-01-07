<?php
// App/Controllers/ProductController.php 
namespace App\Controllers;

use App\Models\Product;

class ProductController extends BaseController {
    // Menampilkan data
    public function index()
    {
        $model = new Product(); //bikin instance dari model product
        $data['product'] = $model->getDataProduct();  //ambil data dari model
        return view('product', $data); //kirim data ke view
    }

    // Menyimpan data input
    public function inputNameProduct()
    {
        $name_product = $this->request->getPost('name_product'); //ambil input dari form

        //buat instance model Product dan masukkan data
        $model = new Product();
        $model->inputNameProduct($name_product);

        // lgsg redirect ke halaman utama setelah data disimpan
        return redirect()->to('/product');
    }

   // Menyimpan data input
    public function addProduct()
    {
        $name_product = $this->request->getPost('name_product');
        $category_product = $this->request->getPost('category_product');
        $quantity_product = $this->request->getPost('quantity_product');

        $model = new Product();
        $model->addProduct([
            'name_product' => $name_product,
            'category_product' => $category_product,
            'quantity_product' => $quantity_product,
            'restock_product' => "No"
        ]);

        // Redirect kembali ke halaman utama
        return redirect()->to('/product');
    }

    public function updateQuantityProduct($id_product = null) {
        $quantity_product = $this->request->getPost('quantity_product');

        $model = new Product();
        $model->updateQuantityProduct($id_product, $quantity_product);

        return redirect()->to('/product');
    }

    public function deleteProduct($id_product = null) {
        $model = new Product();
        $model->deleteProduct($id_product);

        return redirect()->to('/product');
    }

    public function updateRestockStatus($id_product = null) {
        $restock_product = $this->request->getPost('restock_product');

        $model = new Product();
        $model->updateRestockStatus($id_product, $restock_product);

        return redirect()->to('/product');
    }
}
