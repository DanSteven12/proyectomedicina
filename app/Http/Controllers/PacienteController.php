<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarPacienteRequest;
use App\Models\Paciente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PacienteController extends Controller
{
    public function index(Request $request): View
    {
        $pacientes = Paciente::when($request->buscar, fn($q, $b) =>
                $q->where('nombre', 'like', "%{$b}%")
                  ->orWhere('apellido_paterno', 'like', "%{$b}%")
                  ->orWhere('curp', 'like', "%{$b}%")
                  ->orWhere('telefono', 'like', "%{$b}%")
            )
            ->orderBy('apellido_paterno')
            ->paginate(10)
            ->withQueryString();

        return view('pacientes.index', compact('pacientes'));
    }

    public function create(): View
    {
        return view('pacientes.create');
    }

    public function store(GuardarPacienteRequest $request): RedirectResponse
    {
        Paciente::create($request->validated());

        return redirect()->route('pacientes.index')->with('exito', 'Paciente registrado correctamente.');
    }

    public function show(Paciente $paciente): View
    {
        $paciente->load(['citas.doctor.especialidad', 'citas.consulta']);

        return view('pacientes.show', compact('paciente'));
    }

    public function edit(Paciente $paciente): View
    {
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(GuardarPacienteRequest $request, Paciente $paciente): RedirectResponse
    {
        $paciente->update($request->validated());

        return redirect()->route('pacientes.index')->with('exito', 'Paciente actualizado correctamente.');
    }

    public function destroy(Paciente $paciente): RedirectResponse
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('exito', 'Paciente eliminado correctamente.');
    }
}
