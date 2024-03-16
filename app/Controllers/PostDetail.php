<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PostsModel_m;


class PostDetail extends Controller
{
    public function index($id = null)
    {   
        $model = new PostsModel_m();

        $data['post'] = $model->find($id);


       echo view('header');
       echo view('postdetail', $data);
       echo view('footer');
    }
}