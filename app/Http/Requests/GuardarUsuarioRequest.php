<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class GuardarUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('usuario') ? $this->route('usuario')->id : null;

        $passwordRule = $this->isMethod('POST')
            ? ['required', Password::min(8)]
            : ['nullable', Password::min(8)];

        return [
            'name'     => "required|string|max:100",
            'email'    => "required|email|max:150|unique:users,email,{$id}",
            'role_id'  => 'required|integer|exists:roles,id',
            'password' => $passwordRule,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'El nombre es obligatorio.',
            'email.required'   => 'El correo electrónico es obligatorio.',
            'email.unique'     => 'Ya existe un usuario con ese correo.',
            'email.email'      => 'Ingrese un correo electrónico válido.',
            'role_id.required' => 'Debe seleccionar un rol.',
            'role_id.exists'   => 'El rol seleccionado no es válido.',
            'password.required'=> 'La contraseña es obligatoria.',
            'password.min'     => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
}
