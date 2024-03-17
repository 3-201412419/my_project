<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Posts_m;

class Posts extends Controller
{
    public function index()
    {
        $model = new Posts_m(); // 모델 인스턴스 생성
        $query = $this->request->getVar('query') ?? ''; // 사용자 입력 검색어 받기, 없으면 빈 문자열

        // 검색어가 있는 경우와 없는 경우를 처리
        if (!empty($query)) {
            $posts = $model->groupStart()
                           ->like('title', $query)
                           ->orLike('author', $query)
                           ->orLike('company_name', $query) // 예시 필드
                           ->groupEnd()
                           ->findAll();
        } else {
            $posts = $model->findAll();
        }

        // 게시글 목록 뷰 파일로 데이터 전달 (여기서 $query도 전달)
        echo view('header');
        echo view('posts', ['posts' => $posts, 'query' => $query]);
        echo view('footer');
    }
}