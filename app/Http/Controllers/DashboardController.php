<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $totalPacientes  = Paciente::count();
        $totalDoctores   = Doctor::count();
        $totalCitas      = Cita::count();
        $citasHoy        = Cita::whereDate('fecha', today())->count();
        $totalConsultas  = Consulta::count();

        $citasRecientes = Cita::with(['paciente', 'doctor'])
            ->when($user->role_id === RoleEnum::DOCTOR->value, function ($q) use ($user) {
                $q->whereHas('doctor', fn($d) => $d->where('user_id', $user->id));
            })
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalPacientes',
            'totalDoctores',
            'totalCitas',
            'citasHoy',
            'totalConsultas',
            'citasRecientes'
        ));
    }
}
