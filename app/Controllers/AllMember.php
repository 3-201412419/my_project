<?php 

namespace App\Controllers;

use App\Models\AllMember_m;

class AllMember extends BaseController {
    public function index() {
        $model = new AllMember_m();
        $members = $model->getAllMembers(); // 모든 회원 데이터 가져오기

        // $data 배열에 회원 데이터 추가
        $this->data['members'] = $members;

        // 모든 데이터를 뷰에 전달
        echo view('header', $this->data);
        echo view('allmember', $this->data);
        echo view('footer', $this->data);
    }
}