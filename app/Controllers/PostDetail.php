<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Posts_m;

class PostDetail extends Controller
{
    public function index($id = null)
    {
        $model = new Posts_m();
        $post = $model->find($id);

        // 조회수 증가
        $model->incrementViews($id);

        echo view('header');
        echo view('postdetail', ['post' => $post]);
        echo view('footer');
    }
}