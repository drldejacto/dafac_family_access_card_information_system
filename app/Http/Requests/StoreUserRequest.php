<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'middle_name' => ['string', 'max:100'],
            'last_name' => ['required', 'string'],
            'age' => ['numeric'],
            'sex' => ['required', 'string', 'max:6'],
            'complete_address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:11'],
            'date_of_birth' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
