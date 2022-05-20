<?php

namespace App\Http\Requests;

use App\Models\DesignNumber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDesignNumberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('design_number_create');
    }

    public function rules()
    {
        return [
            'design_name'   => [
                'string',
                'required',
            ],
            'design_number' => [
                'string',
                'required',
            ],
            'product_id'    => [
                'required',
                'integer',
            ],
        ];
    }
}
