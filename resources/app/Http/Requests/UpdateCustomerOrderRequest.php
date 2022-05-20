<?php

namespace App\Http\Requests;

use App\Models\CustomerOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCustomerOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_order_edit');
    }

    public function rules()
    {
        return [
            'customer_id'   => [
                'required',
                'integer',
            ],
            'design_id'     => [
                'required',
                'integer',
            ],
            'purity'        => [
                'string',
                'required',
            ],
            'weight'        => [
                'string',
                'required',
            ],
            'size'          => [
                'string',
                'required',
            ],
            'quantity'      => [
                'string',
                'required',
            ],
            'delivery_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
