<?php

namespace App\Http\Requests;

use App\Models\KarigarOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyKarigarOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('karigar_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:karigar_orders,id',
        ];
    }
}
