<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Signup extends Controller
{
    public function index()
    {
        helper(['form', 'url']);
        
          // 자동등록방지(CAPTCHA) 문자열 생성 로직
          $captchaString = $this->createCaptcha();
        
          // 뷰로 전달할 데이터 배열에 CAPTCHA 문자열을 추가
          $data['captchaString'] = $captchaString;
  

        echo view('header');
        echo view('signup', $data);
        echo view('footer');
    }

    private function createCaptcha()
    {
        helper('text');
        $captchaString = random_string('alnum', 8); // 8자리 랜덤 문자열 생성
    
        // CAPTCHA 이미지 생성 로직
        $image = imagecreatetruecolor(120, 30); // 이미지 사이즈 설정
        $background = imagecolorallocate($image, 255, 255, 255); // 배경색 설정
        $textColor = imagecolorallocate($image, 0, 0, 0); // 텍스트 색상 설정
    
        imagefilledrectangle($image, 0, 0, 120, 30, $background); // 배경 채우기
        imagettftext($image, 20, 0, 10, 25, $textColor, 'path/to/font.ttf', $captchaString); // 텍스트 쓰기
    
        // 이미지 파일 저장
        $captchaDir = WRITEPATH . 'captcha/';
        if (!is_dir($captchaDir)) {
            mkdir($captchaDir, 0777, true);
        }
        $fileName = md5($captchaString . time()) . '.png';
        $filePath = $captchaDir . $fileName;
        imagepng($image, $filePath); // PNG 형식으로 저장
        imagedestroy($image); // 이미지 리소스 해제
    
        // 세션에 CAPTCHA 정보 저장
        session()->set('captcha', $captchaString);
    
        // CAPTCHA 이미지 URL 반환
        $imageUrl = base_url('writable/captcha/' . $fileName);
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