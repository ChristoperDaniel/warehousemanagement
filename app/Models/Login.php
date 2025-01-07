<?php
namespace App\Models;
use CodeIgniter\Model;
class Login extends Model
{
    public function getDataUsers($username, $password) {
        $db = \Config\Database::connect();
        $queryString = 'SELECT name FROM user 
                        WHERE username = ? 
                        AND password = ?';
        $query = $db->query($queryString, [$username, $password]);
        $results = $query->getResult();
        return count($results);
    }
}