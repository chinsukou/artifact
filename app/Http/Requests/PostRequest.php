<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    //  投稿のバリデーション
    public function rules()
    {
        return [
            'post.title' => 'required|string|max:100',
            'post.body' => 'required|string|max:1000'
        ];
    }
    // エラーメッセージを日本語化
    public function messages()
    {
        return [
            'post.title.required' => 'タイトルを入力してください',
            'post.title.max' => 'タイトルは１００字以内で入力してください',
            'post.body.required' => '投稿本文を入力してください',
            'post.body.max' => '投稿本文は1000字以内で入力してください'
        ];
    }
}
