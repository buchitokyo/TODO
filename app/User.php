<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mail\ResetPassword; // 追加
use Illuminate\Support\Facades\Mail; // 追加

class User extends Authenticatable
{
    use Notifiable;

    public function folders() {
      //hasManyの関係   folder Modelに関して
      return $this->hasMany('App\Folder');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * ★ パスワード再設定メールを送信する
    */
     public function sendPasswordResetNotification($token)
     {
         Mail::to($this)->send(new ResetPassword($token));
     }
}
