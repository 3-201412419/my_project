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
        $imageUrl = base_url('img/captcha/' . $fileName);
        return $imageUrl;
    }

    public function register()
    {
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();
    
        // 유효성 검증 규칙 설정
        $validation->setRules([
            'user_id' => 'required|min_length[5]|max_length[12]|is_unique[users.user_id]',
            'password' => 'required|min_length[8]',
            'confirmPassword' => 'matches[password]',
            'name' => 'required',
            // 자동등록방지 코드 검증 로직은 예제에서 생략
        ]);
    
        // 사용자가 입력한 CAPTCHA 값을 가져옵니다.
        $userInputCaptcha = $this->request->getPost('captcha');
        // 세션에 저장된 CAPTCHA 값을 가져옵니다.
        $storedCaptcha = session()->get('captcha');
    
        // 입력한 CAPTCHA 값과 세션에 저장된 값이 다를 경우
        if ($userInputCaptcha !== $storedCaptcha) {
            // 사용자에게 CAPTCHA 불일치 메시지를 반환하고 이전 페이지로 리다이렉션합니다.
            return redirect()->back()->withInput()->with('captchaError', 'CAPTCHA가 일치하지 않습니다.');
        }
    
        // 유효성 검증 실패 시, 에러 메시지와 함께 이전 페이지로 리다이렉션합니다.
        if(!$validation->withRequest($this->request)->run()) {
            // 유효성 검증 실패 시 에러 메시지를 담아 리다이렉션
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        // UserModel을 사용하여 사용자 데이터를 데이터베이스에 저장합니다.
        $userModel = new UserModel();
        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // 비밀번호 암호화
            'name' => $this->request->getPost('name'),
            // 필요한 추가 데이터 필드...
        ];
        $userModel->save($data);
    
        // 사용자 등록 후 로그인 페이지로 리다이렉션합니다.
        return redirect()->to('/login');
    }
}