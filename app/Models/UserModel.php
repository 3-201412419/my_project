<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['user_id', 'name', 'email', 'phone', 'password'];
    
    // 이 부분은 모델에서 사용자를 조회하는 예시 메서드입니다. 실제 사용 시에는 Controller에서 호출하여 사용합니다.
    public function getUserById($user_id)
    {
        return $this->where('user_id', $user_id)->first();
    }
}