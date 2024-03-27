<?php namespace App\Controllers;

class Logout extends BaseController
{
    public function index()
    {
        session()->destroy(); // 세션 파괴
        return redirect()->to('/login'); // 로그인 페이지로 리다이렉션
    }
}