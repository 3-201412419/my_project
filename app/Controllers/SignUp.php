<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Signup extends Controller
{
    public function index()
    {
        helper(['form', 'url']);
    
        // CAPTCHA 이미지 URL 생성
        $captchaImageUrl = $this->createCaptcha();
        
        // 뷰로 전달할 데이터 배열
        $data = [
            'captchaImageUrl' => $captchaImageUrl,
        ];
    
        echo view('header');
        echo view('signup', $data); // CAPTCHA 이미지 URL을 포함한 데이터 배열 전달
        echo view('footer');
    }

    private function createCaptcha()
    {
        helper('text');
        $captchaString = random_string('alnum', 8); // 8자리 랜덤 문자열 생성
        
        // CAPTCHA 이미지 생성 로직
        $image = imagecreatetruecolor(120, 30);
        $background = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);
        imagefilledrectangle($image, 0, 0, 120, 30, $background);
        $fontPath = FCPATH . 'public/font/stardust.ttf';
        imagettftext($image, 20, 0, 10, 25, $textColor, $fontPath, $captchaString);
        
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
        $imageUrl = base_url('img/captcha/' . $fileName);
        return $imageUrl;
    }

    public function register()
    {
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validation->setRules([
            'username' => 'required|min_length[5]|max_length[12]',
            'password' => 'required|min_length[8]',
            'confirmPassword' => 'matches[password]',
            'name' => 'required',
            // 자동등록방지 코드 검증 로직 추가 (예제에선 생략)
        ]);

        $userInputCaptcha = $this->request->getPost('captcha');
        $storedCaptcha = session()->get('captcha');
    
        if ($userInputCaptcha !== $storedCaptcha) {
            // CAPTCHA 불일치
            return redirect()->back()->withInput()->with('captchaError', 'CAPTCHA가 일치하지 않습니다.');
        }
    

        if(!$validation->withRequest($this->request)->run())
        {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'name' => $this->request->getPost('name'),
            // 추가 데이터 필드...
        ];
        $userModel->save($data);
        return redirect()->to('/login');
    }
}