<?php

namespace App\Http\Requests;

use App\Models\Karigar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKarigarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('karigar_create');
    }

    public function rules()
    {
        return [
            'name'                => [
                'string',
                'required',
            ],
            'mobile_no'           => [
                'required',
                'integer',
                'min:6666666666',
                'max:9999999999',
                'unique:karigars,mobile_no',
            ],
            'alternate_mobile_no' => [
                'nullable',
                'integer',
                'min:6666666666',
                'max:9999999999',
            ],
            

            'address'             => [
                'string',
                'nullable',
            ],
            'district'            => [
                'string',
                'nullable',
            ],
            'city'                => [
                'string',
                'nullable',
            ],
            'date_of_birth'       => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'date_of_anniversary' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
