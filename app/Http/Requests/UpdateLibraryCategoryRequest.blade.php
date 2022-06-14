<?php

namespace App\Http\Requests;

use App\Models\LibraryCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLibraryCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('library_category_update');
    }

    public function rules()
    {
        return [
            'library_category'       => [
                'string',
                'required',
            ],
        ];
    }
}
