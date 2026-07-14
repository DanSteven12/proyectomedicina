<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\GuardarConsultaRequest;
use App\Models\Cita;
use App\Models\Consulta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConsultaController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $consultas = Consulta::with(['cita.paciente', 'cita.doctor'])
            ->when($user->role_id === RoleEnum::DOCTOR->value, function ($q) use ($user) {
                $q->whereHas('cita.doctor', fn($d) => $d->where('user_id', $user->id));
            })
            ->when($request->buscar, fn($q, $b) =>
                $q->whereHas('cita.paciente', fn($p) =>
                    $p->where('nombre', 'like', "%{$b}%")
                      ->orWhere('apellido_paterno', 'like', "%{$b}%")
                )
            )
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('consultas.index', compact('consultas'));
    }

    public function create(Request $request): View
    {
        $user = $request->user();

        $citas = Cita::with(['paciente', 'doctor'])
            ->whereDoesntHave('consulta')
            ->where('estado', 'Confirmada')
            ->when($user->role_id === RoleEnum::DOCTOR->value, function ($q) use ($user) {
                $q->whereHas('doctor', fn($d) => $d->where('user_id', $user->id));
            })
            ->orderBy('fecha')
            ->get();

        return view('consultas.create', compact('citas'));
    }

    public function store(GuardarConsultaRequest $request): RedirectResponse
    {
        $consulta = Consulta::create($request->validated());

        Cita::find($request->cita_id)->update(['estado' => 'Finalizada']);

        return redirect()->route('consultas.show', $consulta)
            ->with('exito', 'Consulta registrada correctamente.');
    }

    public function show(Consulta $consulta): View
    {
        $consulta->load(['cita.paciente', 'cita.doctor.especialidad']);

        return view('consultas.show', compact('consulta'));
    }

    public function edit(Consulta $consulta): View
    {
        $consulta->load(['cita.paciente', 'cita.doctor']);

        return view('consultas.edit', compact('consulta'));
    }

    public function update(GuardarConsultaRequest $request, Consulta $consulta): RedirectResponse
    {
        $consulta->update($request->validated());

        return redirect()->route('consultas.show', $consulta)
            ->with('exito', 'Consulta actualizada correctamente.');
    }

    public function destroy(Consulta $consulta): RedirectResponse
    {
        $consulta->cita->update(['estado' => 'Confirmada']);
        $consulta->delete();

        return redirect()->route('consultas.index')->with('exito', 'Consulta eliminada correctamente.');
    }
}
