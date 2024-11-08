<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::getUsers();
        return view('usuarios/users', compact('users'));
    }
    
    public function my_profile()
    {
        $id_user = session('id_usuario');

        $user = User::getUserById($id_user);
        $branch = User::getBranchByUserId($id_user);
        $user['created_at'] = date('d-m-Y', strtotime($user['created_at']));
        
        return view('usuarios/my_profile', compact('user', 'branch'));
    }
}