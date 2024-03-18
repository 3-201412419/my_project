<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Posts_m;

class PostDetail extends Controller
{
    public function index($id = null)
    {   
        $model = new Posts_m(); // 모델 인스턴스 생성
        // 게시글 ID로 데이터 조회
        $data['post'] = $model->find($id);

        $model->incrementViews($id);

        // 게시글 상세 정보 뷰 파일로 데이터 전달
        echo view('header');
        echo view('postdetail', $data);
        echo view('footer');
    }
}