<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
  public function tasks(){
    return $this -> hasMany('App\Task');
  }
  
  public function user() // 単数形
    {
        return $this->belongsTo('App\User');
    }
}
