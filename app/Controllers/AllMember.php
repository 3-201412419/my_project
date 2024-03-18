<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AllMember_m;

class AllMember extends Controller {
    public function index() {
        $model = new AllMember_m();
        $members = $model->getAllMembers(); // 모든 회원 데이터 가져오기

        echo view('header');
        echo view('allmember', ['members' => $members]); // 뷰에 데이터 전달
        echo view('footer');
    }
}