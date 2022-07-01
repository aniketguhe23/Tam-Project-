<?php

namespace App\Http\Requests;

use App\Models\PrivacyPolicy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePrivacyPolicyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('privacy_policy_create');
    }

    public function rules()
    {
        return [
            'url'       => [
                'string',
                'required',
            ],
          
        ];
    }
}
