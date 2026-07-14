<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarPacienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('paciente') ? $this->route('paciente')->id : null;

        return [
            'nombre'           => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'sexo'             => 'required|in:Masculino,Femenino',
            'fecha_nacimiento' => 'nullable|date|before:today',
            'curp'             => "nullable|string|size:18|unique:pacientes,curp,{$id}",
            'telefono'         => 'nullable|string|max:15',
            'correo'           => 'nullable|email|max:150',
            'direccion'        => 'nullable|string',
            'codigo_postal'    => 'nullable|string|size:5|regex:/^[0-9]{5}$/',
            'estado'           => 'nullable|string|max:80',
            'municipio'        => 'nullable|string|max:80',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'           => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'sexo.required'             => 'El sexo es obligatorio.',
            'sexo.in'                   => 'El sexo debe ser Masculino o Femenino.',
            'fecha_nacimiento.date'     => 'La fecha de nacimiento no es válida.',
            'fecha_nacimiento.before'   => 'La fecha de nacimiento debe ser anterior a hoy.',
            'curp.size'                 => 'La CURP debe tener exactamente 18 caracteres.',
            'curp.unique'               => 'Ya existe un paciente con esa CURP.',
            'correo.email'              => 'Ingrese un correo electrónico válido.',
            'codigo_postal.size'        => 'El código postal debe tener exactamente 5 dígitos.',
            'codigo_postal.regex'       => 'El código postal debe contener solo números.',
        ];
    }
}
