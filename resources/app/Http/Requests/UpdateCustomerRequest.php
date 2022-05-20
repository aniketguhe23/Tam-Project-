<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_edit');
    }

    public function rules()
    {
        return [
            'customer_name'       => [
                'string',
                'required',
            ],
            'firm_name'           => [
                'string',
                'nullable',
            ],
            'mobile_no'           => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:customers,mobile_no,' . request()->route('customer')->id,
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
                'string',
                'nullable',
            ],
        ];
    }
}
