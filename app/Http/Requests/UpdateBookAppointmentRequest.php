<?php

namespace App\Http\Requests;

use App\Models\BookAppointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bookappointment_edit');
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
