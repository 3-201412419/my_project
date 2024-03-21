<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends Controller
{
    public function index()
    {
        // 로그인 페이지를 보여주는 뷰를 렌더링합니다.
        echo view('header');
        echo view('login');
        echo view('footer');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();
        $user_id = $this->request->getPost('user_id');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $user_id)->first();

        // 사용자가 존재하고 비밀번호가 맞는지 확인합니다.
        if($user && password_verify($password, $user['password']))
        {
            $sessionData = [
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'logged_in' => TRUE,
            ];

            $session->set($sessionData);
            return redirect()->to('/dashboard'); // 로그인 성공 시 리다이렉션할 페이지
        }
        else
        {
            $session->setFlashdata('msg', '아이디 또는 비밀번호가 잘못되었습니다.');
            return redirect()->to('/login');
        }
    }
}