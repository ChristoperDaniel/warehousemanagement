<?php
namespace App\Models;
use CodeIgniter\Model;

class LoginProduct extends Model {
    public function getDataUserProduct($email, $password){
        $db = \Config\Database::connect();
        $queryString = 'SELECT name FROM users_product WHERE
                        email = "'.$email.'"
                        AND password = "'.$password.'"'; 
        $query = $db->query($queryString);
        $results = $query->getResult();
        return count($results);
    }
}