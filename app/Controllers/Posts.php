<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Posts_m;


class Posts extends Controller
{
    public function index()
    {
        $model = new Posts_m();
        $query = $this->request->getVar('query') ?? '';
        
        // searchPosts 메서드를 사용하여 검색 결과 가져오기
        $posts = $model->searchPosts($query);

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

    public function store() {
        $model = new Posts_m();
        
        // 글 제목과 내용(이미지 URL 포함)을 요청에서 가져옵니다.
        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'), // 이미지 URL이 포함된 HTML
        ];
        
        if ($model->save($data)) {
            return redirect()->to('/posts'); // 글 목록 페이지로 리다이렉션
        } else {
            return redirect()->back()->withInput()->with('error', '게시글 저장 실패');
        }
    }


    public function upload_image() {
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName(); // 파일명을 무작위로 생성
                // 파일을 img/upload 폴더로 이동
                $file->move(FCPATH . 'img/upload', $newName);
                
                // 업로드된 이미지의 URL을 생성
                $imageUrl = base_url('img/upload/' . $newName);
                
                // Quill 에디터에서 요구하는 형식으로 응답을 반환
                return $this->response->setJSON(['success' => true, 'url' => $imageUrl]);
            }
        }
        // 업로드 실패 시 응답
        return $this->response->setJSON(['success' => false, 'msg' => 'Failed to upload image.']);
    }
}