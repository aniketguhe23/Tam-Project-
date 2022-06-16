<?php

namespace App\Http\Requests;

use App\Models\Library;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLibraryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('library_create');
    }

    public function rules()
    {
        return [
            'link'       => [
                'string',
                'required',
            ],
            'source'           => [
                'string',
                'nullable',
            ],
            'description'           => [
                'string',
                'nullable',
            ],
          
        ];
    }
}
