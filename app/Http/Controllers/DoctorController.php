<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\GuardarDoctorRequest;
use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function index(Request $request): View
    {
        $doctores = Doctor::with(['especialidad', 'usuario'])
            ->when($request->buscar, fn($q, $b) =>
                $q->where('nombre', 'like', "%{$b}%")
                  ->orWhere('apellido_paterno', 'like', "%{$b}%")
                  ->orWhere('cedula_profesional', 'like', "%{$b}%")
            )
            ->orderBy('apellido_paterno')
            ->paginate(10)
            ->withQueryString();

        return view('doctores.index', compact('doctores'));
    }

    public function create(): View
    {
        $especialidades = Especialidad::orderBy('nombre')->get();
        $usuarios = User::where('role_id', RoleEnum::DOCTOR->value)
            ->whereDoesntHave('doctor')
            ->orderBy('name')
            ->get();

        return view('doctores.create', compact('especialidades', 'usuarios'));
    }

    public function store(GuardarDoctorRequest $request): RedirectResponse
    {
        Doctor::create($request->validated());

        return redirect()->route('doctores.index')->with('exito', 'Doctor registrado correctamente.');
    }

    public function edit(Doctor $doctor): View
    {
        $especialidades = Especialidad::orderBy('nombre')->get();
        $usuarios = User::where('role_id', RoleEnum::DOCTOR->value)
            ->where(fn($q) =>
                $q->whereDoesntHave('doctor')
                  ->orWhere('id', $doctor->user_id)
            )
            ->orderBy('name')
            ->get();

        return view('doctores.edit', compact('doctor', 'especialidades', 'usuarios'));
    }

    public function update(GuardarDoctorRequest $request, Doctor $doctor): RedirectResponse
    {
        $doctor->update($request->validated());

        return redirect()->route('doctores.index')->with('exito', 'Doctor actualizado correctamente.');
    }

    public function destroy(Doctor $doctor): RedirectResponse
    {
        if ($doctor->citas()->exists()) {
            return redirect()->route('doctores.index')
                ->with('error', 'No se puede eliminar un doctor con citas registradas.');
        }

        $doctor->delete();

        return redirect()->route('doctores.index')->with('exito', 'Doctor eliminado correctamente.');
    }
}
