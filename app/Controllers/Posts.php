<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Posts_m;
use CodeIgniter\Files\File;

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


    public function create()
    {
        echo view ('header');
        echo view ('postscreate');
        echo view ('footer');
    }

    public function store()
    {
        $model = new Posts_m();
    
        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            // 필요한 나머지 필드들...
        ];
    
        if ($model->save($data)) {
            // 데이터베이스에 성공적으로 저장된 경우
            return redirect()->to('/posts'); // 게시글 목록 페이지로 리다이렉션
        } else {
            // 저장 실패 처리
            return redirect()->back()->withInput()->with('error', '게시글 저장 실패');
        }
    }


    public function upload_image() {
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'img/upload', $newName);
                // 업로드 성공 시, Quill에서 요구하는 형식으로 응답
                return $this->response->setJSON(['success' => true, 'url' => base_url('img/upload/' . $newName)]);
            }
        }
        // 업로드 실패 시 응답
        return $this->response->setJSON(['success' => false, 'msg' => 'Failed to upload image.']);
    }
}