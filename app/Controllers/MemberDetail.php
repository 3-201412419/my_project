<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MemberDetailModel_m; // 수정된 모델 이름 사용

class MemberDetail extends Controller
{
    public function index()
    {   
        echo view('header');
        echo view('memberdetail');
        echo view('footer');
    }

    public function saveMemo()
    {
        $memberId = $this->request->getVar('member_id'); // 회원 ID
        $memoContent = $this->request->getVar('memo'); // 메모 내용

        $model = new MemberDetailModel_m();
        
        if ($model->saveMemo($memberId, $memoContent)) {
            // 메모 저장에 성공했을 경우의 처리
            return $this->response->setJSON(['status' => 'success', 'message' => '메모 저장 성공']);
        } else {
            // 메모 저장에 실패했을 경우의 처리
            return $this->response->setJSON(['status' => 'error', 'message' => '메모 저장 실패']);
        }
    }
}