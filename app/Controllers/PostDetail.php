<?php namespace App\Controllers;

use App\Models\Posts_m;
use App\Models\Comment_m; // 댓글 모델 사용을 위한 추가

class PostDetail extends BaseController {
    public function index($id = null) {
        $postModel = new Posts_m();
        $commentModel = new Comment_m(); // 댓글 모델 인스턴스 생성

        $post = $postModel->find($id);

        // 조회수 증가
        $postModel->incrementViews($id);

        // 댓글 목록 조회
        $comments = $commentModel->where('post_id', $id)->orderBy('created_at', 'desc')->findAll();

        // BaseController의 $data 배열에 post와 comments 추가
        $this->data['post'] = $post;
        $this->data['comments'] = $comments; // 댓글 목록을 뷰에 전달

        // 데이터와 함께 뷰 렌더링
        echo view('header', $this->data);
        echo view('postdetail', $this->data); // 댓글 데이터를 포함한 뷰 렌더링
        echo view('footer', $this->data);
    }
}