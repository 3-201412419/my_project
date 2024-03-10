<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function index()
    {

        error_reporting(-1);
        ini_set('display_errors', '1');
        
        echo "123";
        $model = new UserModel();

        $model->save([
            'name'  => 'John Doe',
            'email' => 'john@example.com'
        ]);

        $data['users'] = $model->findAll();

        return view('users', $data);
    }
}
