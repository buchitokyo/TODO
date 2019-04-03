<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'content' => 'max:100',
            'due_date' => 'required|date|after_or_equal:today',
            'staff_id' => 'required',
         //after_or_equal after_or_equal（特定の日付と同じまたはそれ以降の日付であること）を使用
         //引数として today を指定することにより今日を含んだ未来日だけを許容
        ];
    }

    public function attributes(){
        return [
            'title' => 'タイトル',
            'content' => '内容',
            'due_date' => '期限日',
            'staff_id' => '担当者',
      ];
    }


    //FormRequest クラス単位でエラーメッセージするため
    //個別の FormRequest クラスの内部でのみ有効なメッセージを定義できる
    //validation.phpのようなもの
    public function messages(){
        return[
            // キーでメッセージが表示されるべきルールを指定する。
            // ドット区切りで左側が項目、右側がルールを意味する。
             'due_date.after_or_equal' => ':attribute には今日以降の日付を入力して下さい。',
        ];
    }
}
