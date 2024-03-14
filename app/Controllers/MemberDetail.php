<?php namespace App\Controllers;

use CodeIgniter\Controller;

class MemberDetail extends Controller
{
    public function index()
    {   
       echo view('header');
       echo view('memberdetail');
       echo view('footer');
    }
}