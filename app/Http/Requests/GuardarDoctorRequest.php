<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('doctore') ? $this->route('doctore')->id : ($this->route('doctor') ? $this->route('doctor')->id : null);

        return [
            'user_id'           => 'required|integer|exists:users,id',
            'especialidad_id'   => 'required|integer|exists:especialidades,id',
            'nombre'            => 'required|string|max:100',
            'apellido_paterno'  => 'required|string|max:100',
            'apellido_materno'  => 'nullable|string|max:100',
            'cedula_profesional'=> "required|string|max:30|unique:doctores,cedula_profesional,{$id}",
            'telefono'          => 'nullable|string|max:15',
            'correo'            => 'nullable|email|max:150',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required'            => 'Debe seleccionar un usuario.',
            'user_id.exists'              => 'El usuario seleccionado no existe.',
            'especialidad_id.required'    => 'Debe seleccionar una especialidad.',
            'especialidad_id.exists'      => 'La especialidad seleccionada no existe.',
            'nombre.required'             => 'El nombre es obligatorio.',
            'apellido_paterno.required'   => 'El apellido paterno es obligatorio.',
            'cedula_profesional.required' => 'La cédula profesional es obligatoria.',
            'cedula_profesional.unique'   => 'Ya existe un doctor con esa cédula profesional.',
            'correo.email'                => 'Ingrese un correo electrónico válido.',
        ];
    }
}
