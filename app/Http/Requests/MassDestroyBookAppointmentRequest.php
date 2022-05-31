<?php

namespace App\Http\Requests;

use App\Models\BookAppointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBookAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bookappointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bookappointment,id',
        ];
    }
}
