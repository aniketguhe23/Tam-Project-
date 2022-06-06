<?php

namespace App\Http\Requests;

use App\Models\StoreCounselor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCounselorAssignmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('counselorassignment_create');
    }

    public function rules()
    {
        return [
            'counselor_id' => [
                'integer',
                'required',
            ],
            'category_id' => [
                'integer',
                'required',
            ],
            'user_id' => [
                'integer',
                'required',
            ],
        ];
    }
}
