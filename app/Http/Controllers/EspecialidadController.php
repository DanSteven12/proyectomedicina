<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarEspecialidadRequest;
use App\Models\Especialidad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EspecialidadController extends Controller
{
    public function index(Request $request): View
    {
        $especialidades = Especialidad::when($request->buscar, fn($q, $b) =>
                $q->where('nombre', 'like', "%{$b}%")
            )
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('especialidades.index', compact('especialidades'));
    }

    public function create(): View
    {
        return view('especialidades.create');
    }

    public function store(GuardarEspecialidadRequest $request): RedirectResponse
    {
        Especialidad::create($request->validated());

        return redirect()->route('especialidades.index')->with('exito', 'Especialidad creada correctamente.');
    }

    public function edit(Especialidad $especialidad): View
    {
        return view('especialidades.edit', compact('especialidad'));
    }

    public function update(GuardarEspecialidadRequest $request, Especialidad $especialidad): RedirectResponse
    {
        $especialidad->update($request->validated());

        return redirect()->route('especialidades.index')->with('exito', 'Especialidad actualizada correctamente.');
    }

    public function destroy(Especialidad $especialidad): RedirectResponse
    {
        if ($especialidad->doctores()->exists()) {
            return redirect()->route('especialidades.index')
                ->with('error', 'No se puede eliminar una especialidad que tiene doctores asignados.');
        }

        $especialidad->delete();

        return redirect()->route('especialidades.index')->with('exito', 'Especialidad eliminada correctamente.');
    }
}
