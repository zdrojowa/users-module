<?php

namespace Selene\Modules\UsersModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Zdrojowa\AuthModule\AuthModule;

class UserStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'permission_package_id' => 'nullable|exists:permission_packages,id',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Te pole jest wymagane.',
            'name.string' => 'Wprowadź prawidłową wartość.',
            'name.max' => 'Imię i nazwisko może mieć maksymalnie 255 znaków',
            'email.required' => 'Te pole jest wymagane.',
            'email.string' => 'Email jest niepoprawny.',
            'email.email' => 'Email jest niepoprawny.',
            'email.max' => 'Email może mieć makymalnie 255 znaków.',
            'email.unique' => 'Email musi być unikalny.',
            'password.required' => 'Te pole jest wymagane.',
            'password.string' => 'Hasło jest niepoprawne.',
            'password.min' => 'Hasło musi zawierać minimalnie 6 znaków.',
            'password.confirmed' => 'Podane hasła muszą być takie same.',
            'permission_package_id' => 'Wybrana paczka uprawnień nie istnieje'
        ];
    }
}
