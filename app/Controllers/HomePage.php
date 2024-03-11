<?php namespace App\Controllers;

use CodeIgniter\Controller;

class HomePage extends Controller
{
    public function index()
    {   
       echo view('header');
       echo view('homepage');
       echo view('footer');
    }
}