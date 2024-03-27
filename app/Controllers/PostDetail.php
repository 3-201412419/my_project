<?php namespace App\Controllers;

use App\Models\Posts_m;

class PostDetail extends BaseController // BaseController 상속
{
    public function index($id = null)
    {
        $model = new Posts_m();
        $post = $model->find($id);

        // 조회수 증가
        $model->incrementViews($id);

        // BaseController의 $data 배열에 post 추가
        $this->data['post'] = $post;

        // 데이터와 함께 뷰 렌더링
        echo view('header', $this->data);
        echo view('postdetail', $this->data);
        echo view('footer', $this->data);
    }
}