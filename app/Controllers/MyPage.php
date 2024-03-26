<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\MemberDetailModel_m;

class MyPage extends Controller
{
    protected $userModel;
    protected $MemberDetailModel_m;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // 부모 클래스의 initController 호출
        parent::initController($request, $response, $logger);

        // 모델 인스턴스화
        $this->userModel = new UserModel();
        $this->MemberDetailModel_m = new MemberDetailModel_m();
    }


    public function index()
    {
        $session = session();
    
        // 로그인 상태 확인
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
    
        $userId = $session->get('user_id');
    
        // 사용자 정보 조회
        $userData = $this->userModel->find($userId);
        $userData = $userData ? (array)$userData : [];
        
        // 회원 정보 조회
        $memberData = $this->MemberDetailModel_m->where('user_id', $userId)->first();
        $memberData = $memberData ? (array)$memberData : [];
    
        // 뷰에 데이터 전달
        $data = [
            'userData' => $userData,
            'memberData' => $memberData,
            'isLoggedIn' => $session->get('logged_in'),
            'userName' => $session->get('user_name')
        ];

        echo view('header', $data);
        echo view('mypage', $data);
        echo view('footer', $data);
    }


    public function edit()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
    
        $userId = $session->get('user_id');
        if (!$userId) {
            // 세션에 user_id가 없으면 로그인 페이지로
            return redirect()->to('/login');
        }

        $userData = $this->userModel->find($userId);
        if (!$userData) {
            $userData = []; // 사용자 정보가 없으면 빈 배열로 처리
        }

        $data = [
            'isLoggedIn' => $session->get('logged_in'),
            'userName' => $session->get('user_name'),
            'userData' => $userData,
        ];
        
        // 사용자 정보가 존재하는 경우, 해당 정보를 편집할 수 있는 edit 페이지로 데이터를 전달
        echo view('header', $data);
        echo view('mypageedit', ['userData' => $userData]);  // 'userData'를 포함한 $data 배열을 전달
        echo view('footer', $data);
    }


    // 회원 정보 업데이트 처리
    public function updateMemberInfo()
    {
        $session = session();

        // 로그인 상태 확인
        if (!$session->get('logged_in')) {
            return redirect()->to('/login'); // 로그인 페이지로 리다이렉션
        }

        $userId = $session->get('user_id');

        $data = $this->request->getPost();
        $this->MemberDetailModel_m->updateMemberInfo($userId, $data);

        return redirect()->to('/mypage');
    }
}