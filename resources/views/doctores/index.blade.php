@extends('layouts.app')
@section('titulo', 'Doctores')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-person-badge-fill me-2" style="color:#0d6efd;"></i>Doctores</h1>
    <a href="{{ route('doctores.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Nuevo Doctor</a>
</div>

<div class="table-card">
    <div class="table-header">
        <form class="d-flex gap-2" method="GET" action="{{ route('doctores.index') }}">
            <input type="text" name="buscar" class="form-control" style="max-width:260px;font-size:0.85rem;" placeholder="Buscar por nombre o cédula..." value="{{ request('buscar') }}">
            <button class="btn btn-outline-secondary btn-sm px-3" type="submit"><i class="bi bi-search"></i></button>
            @if(request('buscar'))<a href="{{ route('doctores.index') }}" class="btn btn-outline-secondary btn-sm px-3"><i class="bi bi-x-lg"></i></a>@endif
        </form>
        <small class="text-muted">{{ $doctores->total() }} registros</small>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Doctor</th><th>Especialidad</th><th>Cédula</th><th>Teléfono</th><th>Correo</th><th class="text-center">Acciones</th></tr></thead>
            <tbody>
                @forelse($doctores as $doctor)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#198754,#0dcaf0);display:flex;align-items:center;justify-content:center;color:white;font-size:0.75rem;font-weight:700;flex-shrink:0;">
                                {{ strtoupper(substr($doctor->nombre, 0, 1) . substr($doctor->apellido_paterno, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:0.875rem;">{{ $doctor->nombre_completo }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-info-subtle text-info border border-info-subtle" style="font-size:0.72rem;border-radius:6px;">{{ $doctor->especialidad->nombre ?? '—' }}</span></td>
                    <td style="font-size:0.83rem;color:#64748b;">{{ $doctor->cedula_profesional }}</td>
                    <td style="font-size:0.83rem;color:#64748b;">{{ $doctor->telefono ?? '—' }}</td>
                    <td style="font-size:0.83rem;color:#64748b;">{{ $doctor->correo ?? '—' }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('doctores.edit', $doctor) }}" class="btn btn-sm btn-outline-warning btn-icon" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                            <form method="POST" action="{{ route('doctores.destroy', $doctor) }}" class="d-inline" onsubmit="return confirm('¿Eliminar al doctor {{ $doctor->nombre_completo }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger btn-icon" title="Eliminar"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4"><i class="bi bi-person-x fs-3 d-block mb-2 opacity-25"></i>No se encontraron doctores</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($doctores->hasPages())<div class="px-3 py-2 border-top">{{ $doctores->links() }}</div>@endif
</div>
@endsection
