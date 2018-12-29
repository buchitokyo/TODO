<?php

namespace App\Http\Controllers;

use App\Folder;  //追加
use Illuminate\Http\Request;
use App\Task;  //Tasksではエラーだったので追加

class TaskController extends Controller
{
  // パラメーターの利用
  public function index(int $id){
    // すべてのフォルダを取得する
      $folders = Folder::all();

      // 選ばれたフォルダを取得する
      $current_folder = Folder::find($id);

      // 選ばれたフォルダに紐づくタスクを取得する model classを使用
      // $tasks = Tasks::where('folder_id', $current_folder->id)->get(); だとエラー
      //$tasks = Task::where('folder_id', $current_folder->id)->get();
      //    ↓
      // Folder ModelでhasManyを定義したためtask()が使える -> はrailsの . と一緒
      $tasks = $current_folder->tasks()->get();


      return view('tasks/index', [
          'folders' => $folders,
          'current_folder_id' => $current_folder->id,
          'tasks' => $tasks,
      ]);
  }
}
