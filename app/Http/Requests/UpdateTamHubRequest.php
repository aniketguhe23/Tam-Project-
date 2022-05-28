<?php

namespace App\Http\Requests;

use App\Models\TamHub;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTamhubRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tamhub_edit');
    }

    public function rules()
    {
        return [
            'organisation_name'       => [
                'string',
                'required',
            ],
          
            'contact_no'           => [
                'required',
                'integer',
                'min:6666666666',
                'max:9999999999',  
            ],
        ];
    }
}
