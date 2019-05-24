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
  /**
   * タスク一覧
   * @param Folder $folder
   * @return \Illuminate\View\View
   */
  // パラメーターの利用
  public function index(Folder $folder)
  {  //int $id
     // ユーザーのフォルダを取得する
      $folders = Auth::user()->folders()->orderBy('created_at', 'asc')->get();

     // 選ばれたフォルダに紐づくタスクを取得する
     //$tasks = Task::paginate(5)->onEachSide(5);
      $tasks = $folder->tasks()->orderBy('created_at', 'desc')->paginate(8);  //get()を削除した

      return view('tasks/index', [
          'folders' => $folders,
          'current_folder_id' => $folder->id,
          'tasks' => $tasks,
      ]);     //compact('tasks') pagenation
  }

  //   public static function getMyCount() {
	// 	// ここに何かの処理
	// 	//count($tasks->where('status',2 )
  //   //\App\Http\Controllers\MyController::getMyCount()
	// }

    /**
     * タスク作成フォーム
     * @param Folder $folder
     * @return \Illuminate\View\View
     */

    public function showCreateForm (Folder $folder)
    {
      $staffs = config('staff');
      return view('tasks/create', [
            'folder_id' => $folder->id,
        ])->with(['staffs' => $staffs]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function create(Folder $folder, CreateTask $request){
      //$current_folder = Folder::find($id);
      // タスクモデルのインスタンスを作成する
      $task = new Task();

      //タイトルに入力値を代入する p.66
      $task->title = $request->title;
      $task->content = $request->content;
      $task->due_date = $request->due_date;
      $task->staff_id = $request->staff_id;

      // インスタンスの状態をデータベースに書き込む
      $folder->tasks()->save($task);

      return redirect()->route('tasks.index',[
        'id' => $folder->id,
      ])->with('my_status', __('タスクが作成されました。'));

    }

    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder,Task $task){
      $staffs = config('staff');
      $this->checkRelation($folder, $task);

      //$task = Task::find($task);

      return view('tasks/edit',[
        'task' => $task,
      ])->with(['staffs' => $staffs]);

    }

    /**
      * タスク編集
      * @param Folder $folder
      * @param Task $task
      * @param EditTask $request
      * @return \Illuminate\Http\RedirectResponse
    */

    //まずリクエストされた ID でタスクデータを取得。これが編集対象
    public function edit ( Folder $folder,Task $task, EditTask $request) {
      //1 リクエストされた ID でタスクデータを取得
      //$task = Task::find($task_id);

      $this->checkRelation($folder, $task);
      //2 編集対象のタスクデータに入力値を詰めて save
      $task->title = $request ->title;
      $task->content = $request ->content;
      $task->status = $request ->status;
      $task->due_date = $request->due_date;
      $task->staff_id = $request->staff_id;
      $task->save();

      //3 編集対象のタスクが属するタスク一覧画面へリダイレクト
      return redirect()->route('tasks.index',[
        'id' => $task->folder_id,
      ])->with('my_status', __('タスクが編集されました。'));
    }

    /**
      * タスク削除
      * @param Folder $folder
      * @param Task $task
      * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(Folder $folder,Task $task)   //Folder $id,Task $task_id
    {
      //1 リクエストされた ID でタスクデータを取得
      //$task = Task::find($task_id);
        $this->checkRelation($folder, $task);
        $task->delete();

        return back()->with('my_status', __('タスクが削除されました。'));
    }


    /**
     * フォルダとタスクの関連性があるか調べる
     * @param Folder $folder
     * @param Task $task
     */
    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }

    /**
      * タスク
      * @param Folder $folder
      * @param Task $task
      * @param EditTask $request
      * @return \Illuminate\Http\RedirectResponse
    */
    //まずリクエストされた ID でタスクデータを取得。これが編集対象
    public function list ( Folder $folder,Task $task) {
      //$task = Task::find($task);
      $staffs = config('staff');
      $this->checkRelation($folder, $task);

       return view('tasks.list', [
          'task' => $task,
       ])->with(['staffs' => $staffs]);
    }

}
