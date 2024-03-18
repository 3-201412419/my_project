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