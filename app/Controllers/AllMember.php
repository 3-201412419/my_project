<?php 

namespace App\Controllers;

use App\Models\AllMember_m;

class AllMember extends BaseController {
    public function index() {
        $model = new AllMember_m();
        $search = $this->request->getGet('search'); // 검색어 가져오기
    
        if (!empty($search)) {
            // 검색어가 있으면 검색 결과를 가져옴
            $members = $model->like('name', $search)->findAll();
        } else {
            // 검색어가 없으면 모든 회원 데이터를 가져옴
            $members = $model->getAllMembers();
        }
    
        // $data 배열에 회원 데이터와 검색어 추가
        $this->data['members'] = $members;
        $this->data['search'] = $search;
    
        // 모든 데이터를 뷰에 전달
        echo view('header', $this->data);
        echo view('allmember', $this->data);
        echo view('footer', $this->data);
    }
}