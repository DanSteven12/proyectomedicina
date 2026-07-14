<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarUsuarioRequest;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index(Request $request): View
    {
        $usuarios = User::with('rol')
            ->when($request->buscar, fn($q, $b) =>
                $q->where('name', 'like', "%{$b}%")
                  ->orWhere('email', 'like', "%{$b}%")
            )
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create(): View
    {
        $roles = Rol::whereIn('id', [2, 3])->orderBy('nombre')->get();

        return view('usuarios.create', compact('roles'));
    }

    public function store(GuardarUsuarioRequest $request): RedirectResponse
    {
        $datos = $request->validated();
        $datos['password'] = Hash::make($datos['password']);

        User::create($datos);

        return redirect()->route('usuarios.index')->with('exito', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario): View
    {
        $roles = Rol::whereIn('id', [2, 3])->orderBy('nombre')->get();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(GuardarUsuarioRequest $request, User $usuario): RedirectResponse
    {
        $datos = $request->validated();

        if (!empty($datos['password'])) {
            $datos['password'] = Hash::make($datos['password']);
        } else {
            unset($datos['password']);
        }

        $usuario->update($datos);

        return redirect()->route('usuarios.index')->with('exito', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario): RedirectResponse
    {
        if ($usuario->id === auth()->id()) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('exito', 'Usuario eliminado correctamente.');
    }
}
