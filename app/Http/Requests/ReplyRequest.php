<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
    public function rules()
    {
        return [
            'reply.body' => 'required|max:100',
        ];
    }
    
    public function messages()
    {
        return [
            'reply.body.required' => '本文を入力してください',
            'reply.body.max' => '本文を100字以内で入力してください',
        ];
    }
}
