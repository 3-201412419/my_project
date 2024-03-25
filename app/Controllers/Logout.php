<?php namespace App\Controllers;

class Logout extends BaseController
{
    public function index()
    {
        session()->destroy(); // 세션 파괴
        return redirect()->to('/my_project/login'); // 로그아웃 후 리다이렉션할 페이지
    }
}