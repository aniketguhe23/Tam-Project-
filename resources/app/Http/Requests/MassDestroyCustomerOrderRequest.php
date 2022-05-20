<?php

namespace App\Http\Requests;

use App\Models\CustomerOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCustomerOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('customer_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:customer_orders,id',
        ];
    }
}
