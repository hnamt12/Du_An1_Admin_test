<?php
namespace App\Models;
use App\Models\BaseModel;

class AccountModel extends BaseModel
{
    protected $table = 'users';

    public function get2Top()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY user_id desc limit 2 ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getAll()
    {
        $sql = "
        SELECT 
        u.user_id                   id,
        u.name                  name ,  
        u.email                     email,
        u.password                  password,
        u.phone_number              phone_number,
        u.created_at                created_at,
        u.updated_at                updated_at,
        u.image                     image,
        a.address_line1                   address,
        a.city                      city
        FROM users u 
        JOIN addresses a ON u.user_id = a.user_id 
        ORDER BY u.user_id DESC 
        ";
        $stmt = $this->pdo->prepare($sql) ; 
        $stmt->execute(); 
        return $stmt->fetchAll();
    }

}
