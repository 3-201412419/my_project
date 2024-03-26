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
        return redirect()->to('/login');
    }

    $userId = $session->get('user_id');
    $data = $this->request->getPost();

    // 유효성 검사 로직 추가
    $validation = \Config\Services::validation();
    $validation->setRules([
        'name' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email',
        'phone' => 'permit_empty|numeric|max_length[15]',
        'company_name' => 'permit_empty|max_length[100]',
        'company_address' => 'permit_empty|max_length[255]',
        'industry' => 'permit_empty|max_length[50]',
        'company_description' => 'permit_empty|max_length[255]',
        'personal_memo' => 'permit_empty|max_length[1000]',
    ]);

    // 유효성 검사 실행
    if (!$validation->withRequest($this->request)->run()) {
        // 유효성 검사 실패 시
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // 모델을 이용한 데이터 업데이트
    if ($this->MemberDetailModel_m->updateMemberInfo($userId, $data)) {
        // 업데이트 성공 시
        return redirect()->to('/mypage')->with('message', '정보가 성공적으로 업데이트되었습니다.');
    } else {
        // 업데이트 실패 시
        return redirect()->back()->with('error', '정보 업데이트에 실패했습니다.');
    }
}
}