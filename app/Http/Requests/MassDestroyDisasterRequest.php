<?php

namespace App\Http\Requests;

use App\Disaster;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDisasterRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('disaster_libraries'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:disaster,id',
        ];
    }
}
