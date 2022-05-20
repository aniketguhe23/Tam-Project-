<?php

namespace App\Http\Requests;

use App\Models\Karigar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKarigarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('karigar_edit');
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
                'min:-2147483648',
                'max:2147483647',
                'unique:karigars,mobile_no,' . request()->route('karigar')->id,
            ],
            'alternate_mobile_no' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
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
