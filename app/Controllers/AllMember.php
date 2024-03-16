<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AllMember_m;

class AllMember extends Controller
{
    public function index()
    {   
      $model = new AllMember_m();

       echo view('header');
       echo view('allmember');
       echo view('footer');
    }
}