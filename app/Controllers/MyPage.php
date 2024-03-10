<?php namespace App\Controllers;

use CodeIgniter\Controller;

class MyPage extends Controller
{
    public function index()
    {   
       echo view('header');
       echo view('my_view');
       echo view('footer');
    }
}