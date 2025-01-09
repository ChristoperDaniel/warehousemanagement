<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Product;
use App\Models\Employee;

class ProductEmployeeFilterController extends ResourceController
{
    public function index()
    {
        return view('product_employee_filter');
    }
    
    public function filterByCategory()
    {
        $category = $this->request->getGet('category');

        if (!$category) {
            return $this->respond(['error' => 'Category is required'], 400);
        }

        $productModel = new Product();
        $employeeModel = new Employee();

        $products = $productModel->where('category_product', $category)->findAll();
        $employees = $employeeModel->where('department', $category)->findAll();

        $result = [];
        foreach ($products as $product) {
            foreach ($employees as $employee) {
                $result[] = [
                    'name_product' => $product['name_product'],
                    'category_product' => $product['category_product'],
                    'quantity_product' => $product['quantity_product'],
                    'name' => $employee['name'],
                    'status' => $employee['status'],
                    'job_title' => $employee['role'],
                ];
            }
        }

        return $this->respond($result, 200);
    }
}
// namespace App\Controllers;

// use CodeIgniter\RESTful\ResourceController;

// class ProductEmployeeFilterController extends ResourceController
// {
//     private function fetchDataFromApi($url)
//     {
//         $ch = curl_init($url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Set timeout untuk cURL

//         $response = curl_exec($ch);
//         curl_close($ch);

//         if ($response === false) {
//             return null;
//         }

//         return json_decode($response, true);
//     }

//     public function filterByCategory()
//     {
//         $category = $this->request->getGet('category'); // Ambil kategori dari query parameter

//         if (!$category) {
//             return $this->respond(['error' => 'Category is required'], 400);
//         }

//         // Ambil data produk dari API
//         $productData = $this->fetchDataFromApi(base_url('/product/getDataProductOnly'));
//         // Ambil data pegawai dari API
//         $employeeData = $this->fetchDataFromApi(base_url('/employee/getDataEmployeeOnly'));

//         if (!$productData || !$employeeData) {
//             return $this->respond(['error' => 'Failed to fetch data from APIs'], 500);
//         }

//         // Filter produk berdasarkan kategori
//         $filteredProducts = array_filter($productData['product'], function ($product) use ($category) {
//             return $product['category_product'] === $category;
//         });

//         // Filter pegawai berdasarkan department
//         $filteredEmployees = array_filter($employeeData['employee'], function ($employee) use ($category) {
//             return $employee['department'] === $category;
//         });

//         // Gabungkan data
//         $result = [];
//         foreach ($filteredProducts as $product) {
//             foreach ($filteredEmployees as $employee) {
//                 $result[] = [
//                     'name_product' => $product['name_product'],
//                     'category_product' => $product['category_product'],
//                     'quantity_product' => $product['quantity_product'],
//                     'name' => $employee['name'],
//                     'status' => $employee['status'],
//                     'job_title' => $employee['role'],
//                 ];
//             }
//         }

//         return $this->respond($result, 200);
//     }
// }