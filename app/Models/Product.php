<?php
// App/Models/Product
namespace App\Models;
use CodeIgniter\Model;

class Product extends Model {
    protected $table = 'product_list';
    protected $primaryKey = 'id_product';
    protected $allowedFields = ['name_product', 'category_product', 'quantity_product'];

    public function getDataProduct() {
        return $this->findAll(); //mengambil semua data dari tabel
    }

    public function addProduct($input)
    {
        return $this->insert($input); //gunakan insert untuk menyimpan data ke kolom
    }

    public function updateQuantityProduct($id_product, $quantity_product) {
        $data = ['quantity_product' => $quantity_product];
        return $this->update($id_product, $data); //gunakan update untuk mengubah data 
    }

    public function deleteProduct($id_product) {
        return $this->delete($id_product); //gunakan update untuk menghapus data 
    }
}

