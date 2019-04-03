<?php

namespace App;

use Carbon\Carbon;  //追加
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  /**
   * 状態定義
   */
   const STATUS = [
     1 => ['label' => '未対応','class' => 'label-danger'],
     2 => ['label' => '対応中','class' => 'label-warning'],
     3 => ['label' => '保留','class' => 'label-info'],
     4 => ['label' => '確認中','class' => 'label-primary'],
     5 => ['label' => '完了','class' => ''],
   ];

   /**
    * 状態のラベル
    * @return string
   */
   public function getStatusLabelAttribute(){

    // 状態値
    $status = $this -> attributes['status']; //statusカラムを参照

    // 定義されていなければ空文字を返す
    if(!isset(self::STATUS[$status])){
      return '';
    }
    //self::STATUS[$status]['label']で、値が出力される
    return self::STATUS[$status]['label'];

   }

   /**
   * 状態を表すHTMLクラス
   * @return string
   */

  public function getStatusClassAttribute(){

    //状態値
    $status = $this -> attributes['status']; //statusカラムを参照

    // 定義されていなければ空文字を返す
    if(!isset(self::STATUS[$status])){
      return '';
    }
      return self::STATUS[$status]['class'];
  }

    /**
     * 整形した期限日
     * @return string
    */

    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }

    public function getStaffNameAttribute() {
      return config('staff.'.$this->staff_id);
    }
}
