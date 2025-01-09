<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\JobAssign;
use App\Models\Product;

class CheckController extends ResourceController
{
    public function index()
    {
        $username = session()->get('username');

        if (!$username) {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }

        return view('check_stock');
    }

    public function restock()
    {
        // Retrieve the product name from the request
        $name_product = $this->request->getGet('product');

        if (!$name_product) {
            return $this->respond(['error' => 'Product name is required'], 400);
        }

        // Initialize models
        $productModel = new Product();
        $jobAssignModel = new JobAssign();

        // Fetch product details based on the name
        $products = $productModel->where('name_product', $name_product)->findAll();

        if (empty($products)) {
            return $this->respond(['error' => 'Product not found'], 404);
        }

        // Fetch related job assignments based on the product name
        $jobs = $jobAssignModel->where('product', $name_product)->findAll();

        if (empty($jobs)) {
            return $this->respond(['error' => 'No job assignments found for the specified product'], 404);
        }

        // Build the result array
        $result = [];
        foreach ($products as $product) {
            foreach ($jobs as $job) {
                $result[] = [
                    'id_product' => $product['id_product'],
                    'name_product' => $product['name_product'],
                    'category_product' => $product['category_product'],
                    'quantity_product' => $product['quantity_product'],
                    // 'restock_product' => $product['restock_product'],
                    'name' => $job['name'],
                    'email' => $job['email'],
                    'category' => $job['category'],
                    'status' => $job['status'],
                ];
            }
        }

        // Respond with the filtered data
        return $this->respond($result, 200);
    }
}
