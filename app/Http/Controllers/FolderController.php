<?php

namespace App\Http\Controllers;

use App\Folder; //追加
use App\Http\Requests\CreateFolder; //追加
use Illuminate\Http\Request;
// Authクラスをインポートする
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

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
    //$folder->save();

    // ユーザーに紐づけて保存
      Auth::user()->folders()->save($folder);

    return redirect()->route('tasks.index',[
      'id'=>$folder->id,
    ])->with('my_status', __('フォルダが作成されました。'));
  }

  /**
    * フォルダ削除
    * @param Folder $folder
    * @return \Illuminate\Http\RedirectResponse
  */

  public function destroy ( $id ){
    $folder = Folder::find($id);

    // Delete The Task...
      $folder->delete();
    return redirect()-> route('home')->with('my_status',__('フォルダを削除しました。'));
  }
}
