<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;  //validationルールオブジェクト

class EditTask extends CreateTask    //EditTask クラスは CreateTask クラスを継承
{
    public function rules()
    {
      $rule = parent::rules();
      //配列のキーを取得する
      //ルールを記述的に構築するには、Rule::inメソッド
      //入力値が許可リストに含まれているか検証する inメソッド
      $status_rule = Rule::in(array_keys(Task::STATUS));
        return $rule + [
          'status' => 'required|' .$status_rule,
          // -> 'in(1, 2, 3)' を出力する
          //'status' => 'required|in(1, 2, 3)',
        ];
    }

    public function attributes (){
      $attributes = parent::attributes();

      return $attributes + [
        'status' => '進捗',
      ];
    }

    public function messages()
    {
        $messages = parent::messages();

        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には' .$status_labels. ' のいずれかを指定して下さい。',
        ];
    }

}
