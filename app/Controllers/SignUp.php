<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Signup extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
    
        $session = session();
        $isLoggedIn = $session->has('logged_in') && $session->get('logged_in');
        
        // CAPTCHA 이미지 URL 생성
        $captchaImageUrl = $this->createCaptcha();
        
        // 뷰로 전달할 데이터 배열
        $data = [
            'captchaImageUrl' => $captchaImageUrl,
            'isLoggedIn' => $isLoggedIn, // isLoggedIn 추가
        ];
    
        echo view('header', $data);
        echo view('signup', $data);
        echo view('footer', $data);
    }

    private function createCaptcha()
    {
        helper('text');
        $captchaString = random_string('alnum', 8); // 8자리 랜덤 문자열 생성
        
        $imageWidth = 250; // 너비 설정
        $imageHeight = 60; // 높이 설정
        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $background = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);
        imagefilledrectangle($image, 0, 0, $imageWidth, $imageHeight, $background);
        $fontPath = FCPATH . 'public/font/stardust.ttf';
        
        $fontSize = 24; // 글꼴 크기 조정
        $textBox = imagettfbbox($fontSize, 0, $fontPath, $captchaString);
        $textWidth = $textBox[2] - $textBox[0];
        $textHeight = $textBox[1] - $textBox[7]; // y 좌표의 정확한 높이 계산
        $x = ($imageWidth - $textWidth) / 2;
        $y = ($imageHeight / 2) + ($textHeight / 2); // y 좌표를 수정하여 텍스트를 중앙으로
        
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $captchaString);
        
        // 이미지 파일 저장 경로
        $captchaDir = FCPATH . 'img/captcha/';
        
        // 이전 CAPTCHA 이미지 파일 삭제
        $files = glob($captchaDir . '*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    
        // 새 CAPTCHA 이미지 파일 저장
        if (!is_dir($captchaDir)) {
            mkdir($captchaDir, 0777, true);
        }
        $fileName = md5($captchaString . time()) . '.png';
        $filePath = $captchaDir . $fileName;
        imagepng($image, $filePath);
        imagedestroy($image);
    
        // 세션에 CAPTCHA 정보 저장
        session()->set('captcha', $captchaString);
    
        // CAPTCHA 이미지 URL 반환
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST']; // 현재 호스트 이름
        $dynamicBaseURL = "{$protocol}://{$host}/";

        // CAPTCHA 이미지 URL을 동적 baseURL을 사용하여 생성
        $imageUrl = "{$dynamicBaseURL}/my_project/img/captcha/{$fileName}";
        return $imageUrl;
    }

    public function register()
    {
        helper(['form', 'url']);
        $validation = \Config\Services::validation();
    
        $validation->setRules([
            'user_id' => 'required|min_length[5]|max_length[12]|is_unique[users.user_id]',
            'password' => 'required|min_length[8]',
            'confirmPassword' => 'matches[password]',
            'name' => 'required',
            'captcha' => 'required'
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(400)->setJSON(['errors' => $validation->getErrors()]);
        }
    
        $userInputCaptcha = $this->request->getPost('captcha');
        $storedCaptcha = session()->get('captcha');
    
        if ($userInputCaptcha !== $storedCaptcha) {
            return $this->response->setStatusCode(400)->setJSON(['errors' => ['captcha' => '자동방지코드가 일치하지 않습니다.']]);
        }
    
        $userModel = new UserModel();
        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'name' => $this->request->getPost('name'),
        ];
    
        if ($userModel->save($data)) {
            return $this->response->setStatusCode(200)->setJSON(['message' => '회원가입에 성공했습니다.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['errors' => ['general' => '회원가입에 실패했습니다.']]);
        }
    }
}