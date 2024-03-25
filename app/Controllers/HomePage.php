<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PostsModel_m;

class HomePage extends BaseController
{
    public function index()
    {  
        $model = new PostsModel_m();
        $data['latestPosts'] = $model->orderBy('created_at', 'DESC')->findAll(3);

        // BaseController에서 설정한 데이터를 $data 배열에 추가
        $data = array_merge($data, $this->data);
        
        echo view('header', $data);
        echo view('homepage', $data);
        echo view('footer', $data);
    }
}