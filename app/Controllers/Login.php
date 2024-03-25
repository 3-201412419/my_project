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
        
        // user_id를 이용해 사용자 정보를 조회합니다.
        $user = $model->where('user_id', $user_id)->first();
        
        // 조회된 사용자 정보가 있는지 확인합니다.
        if ($user === null) {
            // 조회된 사용자 정보를 화면에 출력합니다.
            echo '<pre>';
            print_r($user);
            echo '</pre>';
            exit; // 스크립트 실행 중단
            $session->setFlashdata('msg', '해당 사용자가 존재하지 않습니다.');
            return redirect()->to('/login');
        }

        // 비밀번호가 맞는지 확인합니다.
        if ($user !== null && is_array($user) && isset($user['password']) && is_string($user['password'])) {
            if (password_verify($password, $user['password'])) {
            // 세션 데이터를 설정합니다.
            $sessionData = [
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'logged_in' => TRUE,
            ];
            
            // 사용자 세션을 설정합니다.
            $session->set($sessionData);
            // 로그인 성공 시 대시보드로 리다이렉션합니다.
            return redirect()->to('/dashboard');
        } else {
            // 비밀번호가 틀렸을 경우
            $session->setFlashdata('msg', '아이디 또는 비밀번호가 잘못되었습니다.');
            return redirect()->to('/login');
            }
        }
    }
}
