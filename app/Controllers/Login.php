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
    
        // user_id를 이용해 사용자 정보를 조회합니다.
        $user = $model->where('user_id', $user_id)->first(); // 변경: email -> user_id
    
        // 사용자가 존재하고 비밀번호가 맞는지 확인합니다.
        if ($user && password_verify($password, $user['password'])) {
            // 세션 데이터를 설정합니다.
            $sessionData = [
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'logged_in' => TRUE,
            ];
    
            // 사용자 세션을 설정합니다.
            $session->set($sessionData);
            // 로그인 성공 시 대시보드로 리다이렉션합니다.
            return redirect()->to('/dashboard'); // 로그인 성공 시의 경로가 유지됩니다.
        } else {
            // 사용자가 존재하지 않거나 비밀번호가 틀렸을 경우
            $session->setFlashdata('msg', '아이디 또는 비밀번호가 잘못되었습니다.');
            // 로그인 페이지로 리다이렉션합니다.
            return redirect()->to('/homepage'); // 로그인 실패 시의 경로를 '/homepage'로 수정합니다.
        }
    }
}
