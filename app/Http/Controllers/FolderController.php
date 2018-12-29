<?php

namespace App\Http\Controllers;

use App\Folder; //追加
use App\Http\Requests\CreateFolder; //追加
use Illuminate\Http\Request;

class FolderController extends Controller
{
  public function showCreateForm(){
    return view('folders/create');
  }

  public function create( CreateFolder $request ){  //Request=>CreateFolderへ
    // フォルダモデルのインスタンスを作成する
    $folder = new Folder();

    // タイトルに入力値を代入する p.66
    $folder->title = $request->title;

    // インスタンスの状態をデータベースに書き込む
    $folder->save();

    return redirect()->route('tasks.index',[
      'id'=>$folder->id,
    ]);
  }
}
