<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberDetailModel_m extends Model {
    protected $table = 'member_notebook';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'phone', 'company_name', 'company_address', 'industry', 'company_description', 'personal_memo', 'join_date', 'category_id','user_id'];
    protected $returnType = 'array';

    public function saveMemo($id, $memo) {
        // 여기에서 personal_memo 필드를 업데이트하는 로직 구현
        return $this->update($id, ['personal_memo' => $memo]);
    }

    public function updateMemberInfo($userId, $data)
    {
        return $this->where('user_id', $userId)->save($data);
    }
}


?>