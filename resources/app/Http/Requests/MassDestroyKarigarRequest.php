<?php

namespace App\Http\Requests;

use App\Models\Karigar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyKarigarRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('karigar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:karigars,id',
        ];
    }
}
