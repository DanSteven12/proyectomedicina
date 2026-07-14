<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarConsultaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cita_id'          => 'required|integer|exists:citas,id|unique:consultas,cita_id,' . ($this->route('consulta') ? $this->route('consulta')->id : 'null'),
            'diagnostico'      => 'nullable|string',
            'tratamiento'      => 'nullable|string',
            'receta'           => 'nullable|string',
            'peso'             => 'nullable|numeric|min:0|max:300',
            'talla'            => 'nullable|numeric|min:0|max:250',
            'temperatura'      => 'nullable|numeric|min:30|max:45',
            'presion_arterial' => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'cita_id.required'         => 'Debe seleccionar una cita.',
            'cita_id.exists'           => 'La cita seleccionada no existe.',
            'cita_id.unique'           => 'Esta cita ya tiene una consulta registrada.',
            'peso.numeric'             => 'El peso debe ser un número.',
            'peso.max'                 => 'El peso no puede exceder 300 kg.',
            'talla.numeric'            => 'La talla debe ser un número.',
            'talla.max'                => 'La talla no puede exceder 250 cm.',
            'temperatura.numeric'      => 'La temperatura debe ser un número.',
            'temperatura.min'          => 'La temperatura mínima es 30°C.',
            'temperatura.max'          => 'La temperatura máxima es 45°C.',
        ];
    }
}
