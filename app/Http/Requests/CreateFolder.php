<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //リクエストの内容に基づいた権限チェック 使用しない
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'title' => 'required|max:20', // キーに対応するのが、input 要素の name 属性
        ];                              // |max:20 で追加
    }

    public function attributes(){  //attributesメゾット
      return [
        'title' => 'フォルダ名',
      ];
    }
}
