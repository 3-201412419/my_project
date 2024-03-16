<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PostsModel_m;


class HomePage extends Controller
{
    public function index()
    {  
        $model = new PostsModel_m();

        $data['latestPosts'] = $model->orderBy('created_at', 'DESC')->findAll(3);
        
       echo view('header');
       echo view('homepage', $data);
       echo view('footer');
    }
}