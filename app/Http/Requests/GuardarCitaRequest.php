<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarCitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('cita') ? $this->route('cita')->id : null;

        return [
            'paciente_id'  => 'required|integer|exists:pacientes,id',
            'doctor_id'    => 'required|integer|exists:doctores,id',
            'fecha'        => 'required|date',
            'hora'         => 'required|date_format:H:i',
            'motivo'       => 'required|string',
            'estado'       => 'required|in:Pendiente,Confirmada,Cancelada,Finalizada',
            'observaciones'=> 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'paciente_id.required'  => 'Debe seleccionar un paciente.',
            'paciente_id.exists'    => 'El paciente seleccionado no existe.',
            'doctor_id.required'    => 'Debe seleccionar un doctor.',
            'doctor_id.exists'      => 'El doctor seleccionado no existe.',
            'fecha.required'        => 'La fecha es obligatoria.',
            'fecha.date'            => 'La fecha no es válida.',
            'hora.required'         => 'La hora es obligatoria.',
            'hora.date_format'      => 'El formato de hora debe ser HH:MM.',
            'motivo.required'       => 'El motivo de la cita es obligatorio.',
            'estado.required'       => 'El estado es obligatorio.',
            'estado.in'             => 'El estado seleccionado no es válido.',
        ];
    }
}
