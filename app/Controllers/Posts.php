<?php namespace App\Controllers;

use App\Models\Posts_m;
use App\Models\Comment_m;

class Posts extends BaseController // BaseController 상속
{
    public function index()
    {
        $model = new Posts_m();
        $query = $this->request->getVar('query') ?? '';
        
        // searchPosts 메서드를 사용하여 검색 결과 가져오기
        $posts = $model->searchPosts($query);

        // BaseController의 $data 배열에 posts와 query 추가
        $this->data['posts'] = $posts;
        $this->data['query'] = $query;

        // 데이터와 함께 뷰 렌더링
        echo view('header', $this->data);
        echo view('posts', $this->data);
        echo view('footer', $this->data);
    }

    public function create()
    {
        // 뷰 렌더링 시 $this->data 배열을 전달
        echo view('header', $this->data);
        echo view('postscreate', $this->data);
        echo view('footer', $this->data);
    }

    public function store() {
        $session = session();
    
        // 로그인 상태 확인
        if (!$session->get('logged_in')) {
            // 로그인하지 않은 사용자에 대한 처리
            return $this->response->setJSON(['status' => 'error', 'message' => '로그인이 필요합니다.']);
        }
    
        $model = new Posts_m();
    
        // 게시글 데이터 준비
        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'author' => $session->get('username'), // 세션에서 가져온 username을 author 필드에 지정
        ];
    
        if ($model->save($data)) {
            // 게시글 저장 성공
            return $this->response->setJSON(['status' => 'success', 'redirect' => '/my_project/posts']);
        } else {
            // 게시글 저장 실패
            return $this->response->setJSON(['status' => 'error', 'message' => '게시글 저장 실패']);
        }
    }

    public function upload_image() {
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'img/upload', $newName);
                
                $imageUrl = base_url('img/upload/' . $newName);
                
                return $this->response->setJSON(['success' => true, 'url' => $imageUrl]);
            }
        }
        return $this->response->setJSON(['success' => false, 'msg' => 'Failed to upload image.']);
    }

    public function comment()
{
    $session = session();
    if (!$session->get('logged_in')) {
        return $this->response->setJSON(['status' => 'error', 'message' => '로그인이 필요합니다.']);
    }

    $model = new Comment_m();

    $data = [
        'post_id' => $this->request->getPost('post_id'),
        'author' => $session->get('username'),
        'content' => $this->request->getPost('content'),
    ];

    if ($model->insert($data)) {
        return $this->response->setJSON(['status' => 'success']);
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => '댓글 저장 실패']);
    }
}
}