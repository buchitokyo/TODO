<?php

namespace App\Http\Controllers\Auth;
use App\Folder;  //追加
use App\Task;  //追加
// 忘れずにインポートすること!!
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;  //追加

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
    */
     //protected $redirectTo = '/';
      // protected function redirectTo (){
      //   return redirect()->route('/')->with('my_status', __('ログインしました。'));
      // }

    /**
     * ログイン後の処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @param Folder $folder
     */
    protected function authenticated(Request $request,$folder)
    {
      // ログインユーザーを取得する
      $user = Auth::user();

      // ログインユーザーに紐づくフォルダを一つ取得する
      $folder = $user->folders()->first();

      if (is_null($folder)) {
        // ログインしたら、フォルダがないならばページへ移動
      return redirect('/')->with('my_status', __('ログインしました。'));
      }
      //フォルダがあればそのフォルダのタスク一覧にリダイレクトする
      return redirect()->route('tasks.index', [
          'id' => $folder->id,
      ])->with('my_status', __('ログインしました。'));     //メッセージを出すために
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ユーザーをログアウトさせる
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        //$request->session()->invalidate();

        // ログアウトしたら、トップページへ移動
        return $this->loggedOut($request) ?: redirect('login')->with('my_status', __('ログアウトしました。'));
    }
}
