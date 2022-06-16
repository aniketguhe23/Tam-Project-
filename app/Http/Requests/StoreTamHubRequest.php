<?php

namespace App\Http\Requests;
use App\Models\Tamhub;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTamHubRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tamhub_create');
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
                'min:6000000000',
                'max:9999999999',
            ],
           
            
        ];
    }
}
