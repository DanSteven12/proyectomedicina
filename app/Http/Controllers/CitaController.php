<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\GuardarCitaRequest;
use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CitaController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $citas = Cita::with(['paciente', 'doctor'])
            ->when($user->role_id === RoleEnum::DOCTOR->value, function ($q) use ($user) {
                $q->whereHas('doctor', fn($d) => $d->where('user_id', $user->id));
            })
            ->when($request->buscar, fn($q, $b) =>
                $q->whereHas('paciente', fn($p) =>
                    $p->where('nombre', 'like', "%{$b}%")
                      ->orWhere('apellido_paterno', 'like', "%{$b}%")
                )
            )
            ->when($request->estado, fn($q, $e) => $q->where('estado', $e))
            ->when($request->fecha, fn($q, $f) => $q->whereDate('fecha', $f))
            ->orderByDesc('fecha')
            ->orderBy('hora')
            ->paginate(10)
            ->withQueryString();

        return view('citas.index', compact('citas'));
    }

    public function create(): View
    {
        $pacientes = Paciente::orderBy('apellido_paterno')->get();
        $doctores  = Doctor::with('especialidad')->orderBy('apellido_paterno')->get();

        return view('citas.create', compact('pacientes', 'doctores'));
    }

    public function store(GuardarCitaRequest $request): RedirectResponse
    {
        $duplicada = Cita::where('doctor_id', $request->doctor_id)
            ->where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->exists();

        if ($duplicada) {
            return redirect()->back()->withInput()
                ->with('error', 'El doctor ya tiene una cita agendada en esa fecha y hora.');
        }

        Cita::create($request->validated());

        return redirect()->route('citas.index')->with('exito', 'Cita agendada correctamente.');
    }

    public function show(Cita $cita): View
    {
        $cita->load(['paciente', 'doctor.especialidad', 'consulta']);

        return view('citas.show', compact('cita'));
    }

    public function edit(Cita $cita): View
    {
        $pacientes = Paciente::orderBy('apellido_paterno')->get();
        $doctores  = Doctor::with('especialidad')->orderBy('apellido_paterno')->get();

        return view('citas.edit', compact('cita', 'pacientes', 'doctores'));
    }

    public function update(GuardarCitaRequest $request, Cita $cita): RedirectResponse
    {
        $duplicada = Cita::where('doctor_id', $request->doctor_id)
            ->where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->where('id', '!=', $cita->id)
            ->exists();

        if ($duplicada) {
            return redirect()->back()->withInput()
                ->with('error', 'El doctor ya tiene una cita agendada en esa fecha y hora.');
        }

        $cita->update($request->validated());

        return redirect()->route('citas.index')->with('exito', 'Cita actualizada correctamente.');
    }

    public function destroy(Cita $cita): RedirectResponse
    {
        if ($cita->consulta()->exists()) {
            return redirect()->route('citas.index')
                ->with('error', 'No se puede eliminar una cita que ya tiene consulta registrada.');
        }

        $cita->delete();

        return redirect()->route('citas.index')->with('exito', 'Cita eliminada correctamente.');
    }
}
