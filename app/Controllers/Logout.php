<?php namespace App\Controllers;

class Logout extends BaseController
{
    public function index()
    {
        session()->destroy(); // 세션 파괴
        
        // AJAX 요청에 대한 JSON 응답
        return $this->response->setJSON(['success' => true, 'message' => '로그아웃 되었습니다.']);
    }
}