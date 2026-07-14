<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarEspecialidadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('especialidade') ? $this->route('especialidade')->id : ($this->route('especialidad') ? $this->route('especialidad')->id : null);

        return [
            'nombre'      => "required|string|max:100|unique:especialidades,nombre,{$id}",
            'descripcion' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la especialidad es obligatorio.',
            'nombre.unique'   => 'Ya existe una especialidad con ese nombre.',
            'nombre.max'      => 'El nombre no puede exceder 100 caracteres.',
        ];
    }
}
