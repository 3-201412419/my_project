<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\MemberDetailModel_m;

class MyPage extends Controller
{
    protected $userModel;
    protected $MemberDetailModel_m;

    public function __construct()
    {
        // 모델 인스턴스화
        $this->userModel = new UserModel();
        $this->MemberDetailModel_m = new MemberDetailModel_m();
    }

    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');
    
        // 사용자 정보 조회
        $userData = $this->userModel->find($userId);
        // 객체를 배열로 변환
        $userData = $userData ? (array)$userData : [];
    
        // 회원 정보 조회
        $memberData = $this->MemberDetailModel_m->where('user_id', $userId)->first();
        // 객체를 배열로 변환
        $memberData = $memberData ? (array)$memberData : [];

        $isOwner = ($userId == $memberData['user_id']);

    
        // 뷰에 데이터 전달
        echo view('header');
        echo view('mypage', ['userData' => $userData, 'memberData' => $memberData,  'isOwner' => $isOwner ]);
        echo view('footer');
    }

    // 회원 정보 업데이트 처리
    public function updateMemberInfo()
    {
        $session = session();
        $userId = $session->get('user_id');

        $data = $this->request->getPost();
        $this->MemberDetailModel_m->updateMemberInfo($userId, $data);

        return redirect()->to('/mypage');
    }
}