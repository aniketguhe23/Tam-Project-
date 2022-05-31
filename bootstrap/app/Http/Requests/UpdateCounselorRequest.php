<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCounselorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('counselor_update');
    }

    public function rules()
    {
        return [
            'name'     => [
                'string',
                'required',
            ],
            'category_id'    => [
                'required',
            ],
            'email'    => [
                'required',
                'unique:users',
            ],
            'phone_no'    => [
                'required',
            ],
            'password' => [
                'required',
            ],
            
        ];
    }
}
