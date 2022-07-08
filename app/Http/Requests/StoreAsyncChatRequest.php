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
        return Gate::allows('Async_chat_accses');
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
}
