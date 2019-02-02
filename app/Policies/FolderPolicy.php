<?php

namespace App\Policies;

use App\Folder; //追加
use App\User;  //追加
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * フォルダの閲覧権限
     * @param User $user
     * @param Folder $folder
     * @return bool
     */
    public function view( User $user,Folder $folder)
    {
      return $user->id === $folder->user_id;
    }
}
