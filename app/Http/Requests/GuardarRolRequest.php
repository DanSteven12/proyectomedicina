<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarRolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('rol');

        return [
            'nombre'      => "required|string|max:50|unique:roles,nombre,{$id}",
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del rol es obligatorio.',
            'nombre.unique'   => 'Ya existe un rol con ese nombre.',
            'nombre.max'      => 'El nombre no puede exceder 50 caracteres.',
        ];
    }
}
