<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        $data = $this->data;

        if ($this->data['isLoggedIn']) {
            return redirect()->to('/homepage');
        }

        // 로그인 페이지를 보여주는 뷰를 렌더링합니다.
        echo view('header', $data);
        echo view('login', $data);
        echo view('footer', $data);
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();
    
        $user_id = $this->request->getPost('user_id');
        $password = $this->request->getPost('password');
    
        $user = $model->where('user_id', $user_id)->first();
    
        if ($user === null) {
            return $this->response->setJSON(['status' => 'error', 'message' => '해당 사용자가 존재하지 않습니다.']);
        }
    
        if (password_verify($password, $user['password'])) {
            $sessionData = [
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'logged_in' => TRUE,
                'username' => $user['user_id'],
            ];
    
            $session->set($sessionData);
            return $this->response->setJSON(['status' => 'success', 'redirect' => '/my_project/homepage']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => '아이디 또는 비밀번호가 잘못되었습니다.']);
        }
    }
}
