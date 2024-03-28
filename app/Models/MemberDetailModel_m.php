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

    public function updateMemberInfo($userId, $data) {
        // 먼저 해당 user_id로 데이터가 있는지 확인
        $existingData = $this->where('user_id', $userId)->first();
        
        if ($existingData) {
            // 기존 데이터가 있으면 업데이트
            return $this->where('user_id', $userId)->set($data)->update();
        } else {
            // 기존 데이터가 없으면 삽입
            // 여기에서 user_id도 데이터 배열에 추가
            $data['user_id'] = $userId;
            return $this->insert($data);
        }
    }
}


?>