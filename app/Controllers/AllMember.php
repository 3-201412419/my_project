<?php namespace App\Controllers;

use CodeIgniter\Controller;

class AllMember extends Controller
{
    public function index()
    {   
       echo view('header');
       echo view('allmember');
       echo view('footer');
    }
}