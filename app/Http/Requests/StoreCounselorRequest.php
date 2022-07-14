<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreCounselorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('counselor_create');
    }

    public function rules()
    {
        return [
            'name'     => [
                'string',
                'min:3',
                'max:50',
                'required',
            ],
            'category_id'    => [
                'required',
                'integer',
            ],
            'email'    => [
                'required',
                'unique:users',
            ],
            'phone_no'    => [
                'required',
                'integer',
                'min:6000000000',
                'max:9999999999',
            ],
            'password' => [
                'required',
            ],
            
        ];
    }

    
}
