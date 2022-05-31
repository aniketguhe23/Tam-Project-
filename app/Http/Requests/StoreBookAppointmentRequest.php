<?php

namespace App\Http\Requests;

use App\Models\BookAppointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBookAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bookappointment_create');
    }

    public function rules()
    {
        return [
            'url' => [
                'string',
                'required',
            ],
        ];
    }
}
