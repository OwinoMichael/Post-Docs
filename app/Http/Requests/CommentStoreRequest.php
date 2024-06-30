<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['string', 'required'],
            'body' => ['string', 'required'],
            'user_id' => ['array', 'required'],
            'post_id' => ['array', 'required']

        ];
    }

    public function messages()
    {
        return
        [
            'title.required' => 'Please enter a Title'
        ];
    }
}
