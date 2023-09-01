<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'comment.body' => 'required|max:100',
        ];
    }
    public function messages()
    {
        return [
            'comment.body.required' => '本文を入力してください',
            'comment.body.max' => '本文を100字以内で入力してください'
        ];
    }
}
