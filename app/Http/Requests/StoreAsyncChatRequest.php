<?php

namespace App\Http\Requests;

use App\Models\Async;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAsyncChatRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('async_chat_accses');
    }

    public function rules()
    {
        return [
            'category_id'     => [
                'integer',
                'required',
            ],
            'user_id'    => [
                'integer',
                'required',
            ],
            'message' => [
                'string',
                'required',
            ],
            'labels'    => [
                'string',
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Category id is required',
            'user_id.required' => 'user id is required',
            'message.required' => 'message id is required',
            'labels.required' => 'labels id is required',

        ];
     }
}
