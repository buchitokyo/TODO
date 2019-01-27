<?php

namespace App\Http\Controllers;

use App\Folder;  //追加
use Illuminate\Http\Request;
use App\Http\Requests\EditTask; //追加
use App\Http\Requests\CreateTask; //追加
use App\Task;  //Tasksではエラーだったので追加
use Illuminate\Support\Facades\Auth;  //追加


class TaskController extends Controller
{
  // パラメーターの利用
  public function index(int $id){

      // すべてのフォルダを取得する
      //$folders = Folder::all();

      // ユーザーのフォルダを取得する
      $folders = Auth::user()->folders()->get();

      // 選ばれたフォルダを取得する
      $current_folder = Folder::find($id);

      // 選ばれたフォルダに紐づくタスクを取得する model classを使用
      // $tasks = Tasks::where('folder_id', $current_folder->id)->get(); だとエラー
      // $tasks = Task::where('folder_id', $current_folder->id)->get();
      //    ↓
      // Folder ModelでhasManyを定義したためtasks()が使える -> はrailsの . と一緒
      $tasks = $current_folder->tasks()->get();

//*****************************************************************************************************

     //第一引数がテンプレートファイル名で第二引数がテンプレートに渡すデータ
     //あくまでテンプレート側ではキー名が変数名（任意）で参照できる   プロパティのように参照
      return view('tasks.index', [
          'folders' => $folders,
          'current_folder_id' => $current_folder->id,  //  'id' => $current_folder_id  //view側
          'tasks' => $tasks,
      ]);
  }

    /**
     * GET /folders/{id}/tasks/create
    */

    public function showCreateForm (int $id){
      return view ('tasks.create',[   //'tasks/create' OK
        'folder_id' => $id,
      ]);
    }


    public function create(int $id, CreateTask $request){
      $current_folder = Folder::find($id);
      // タスクモデルのインスタンスを作成する
      $task = new Task();

      //タイトルに入力値を代入する p.66
      $task->title = $request->title;
      $task->due_date = $request->due_date;

      // インスタンスの状態をデータベースに書き込む
      $current_folder->tasks()->save($task);

      return redirect()->route('tasks.index',[
        'id' => $current_folder->id,
      ])->with('my_status', __('タスクが作成されました。'));

    }

    /**
     * GET /folders/{id}/tasks/{task_id}/edit
     */
    public function showEditForm(int $id,int $task_id){
      $task = Task::find($task_id);

      return view('tasks.edit',[
        'task' => $task,
      ]);

    }

    /**
      * タスク編集
      * @param Folder $folder
      * @param Task $task
      * @param EditTask $request
      * @return \Illuminate\Http\RedirectResponse
    */

    //まずリクエストされた ID でタスクデータを取得。これが編集対象
    public function edit ( int $id, int $task_id, EditTask $request) {
      //1 リクエストされた ID でタスクデータを取得
      $task = Task::find($task_id);

      //2 編集対象のタスクデータに入力値を詰めて save
      $task->title = $request ->title;
      $task->status = $request ->status;
      $task->due_date = $request->due_date;
      $task->save();

      //3 編集対象のタスクが属するタスク一覧画面へリダイレクト
      return redirect()->route('tasks.index',[
        'id' => $task -> folder_id,
      ])->with('my_status', __('タスクが編集されました。'));
    }

    /**
      * タスク削除
      * @param Folder $folder
      * @param Task $task
      * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(int $id,int $task_id)   //Folder $id,Task $task_id
    {
      //1 リクエストされた ID でタスクデータを取得
      $task = Task::find($task_id);
      $task->delete();

        return back()->with('my_status', __('タスクが削除されました。'));
    }

}
