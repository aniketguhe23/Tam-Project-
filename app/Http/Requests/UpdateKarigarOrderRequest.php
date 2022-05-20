<?php

namespace App\Http\Requests;

use App\Models\KarigarOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKarigarOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('karigar_order_edit');
    }

    public function rules()
    {
        return [
            'karigar_id'        => [
                'required',
                'integer',
            ],
            'product_design_id' => [
                'required',
                'integer',
            ],
            'per_piece_weight'  => [
                'string',
                'required',
            ],
            'total_weight'      => [
                'string',
                'required',
            ],
            'purity'            => [
                'string',
                'required',
            ],
            'pieces'            => [
                'string',
                'required',
            ],
            'size'              => [
                'string',
                'required',
            ],
            'delivery_date'     => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
