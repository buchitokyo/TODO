<?php

namespace App\Http\Controllers;

use App\Folder;  //追加
use App\Task;  //追加
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
Use App\User;

class UserController extends Controller
{
    public function index (Folder $folder,Task $task)
    {
      $users = User::all();
      return view('users.index',['users' => $users]);
    }
}
