<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    // user_id 필드를 추가함
    protected $allowedFields = ['user_id', 'name', 'email', 'phone', 'password'];
    // 필요한 메서드 추가...
}