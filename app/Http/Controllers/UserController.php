<?php

namespace App\Http\Controllers;

use App\Folder;  //追加
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
Use App\User;

class UserController extends Controller
{
    public function index (Folder $folder)
    {
      $users = User::paginate(8)->onEachSide(5);
      $folders = User::with(['folders'])->get();
      //$tasks = Task::paginate(5)->onEachSide(5);
      $tasks = $folder->tasks()->get();
      return view('users.index', compact('users', 'folders','tasks'));
    }
}
