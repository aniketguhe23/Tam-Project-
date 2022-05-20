<?php

namespace App\Http\Requests;

use App\Models\DesignNumber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDesignNumberRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('design_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:design_numbers,id',
        ];
    }
}
