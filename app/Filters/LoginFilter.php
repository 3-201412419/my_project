<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 세션 인스턴스를 가져옵니다.
        $session = session();

        // 로그인 상태를 체크합니다.
        if (!$session->get('logged_in')) {
            // 로그인 상태가 아니라면 로그인 페이지로 리다이렉션합니다.
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 이 메서드는 이 예제에서 사용되지 않습니다.
    }
}