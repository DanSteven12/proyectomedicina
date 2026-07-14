@extends('layouts.app')
@section('titulo', 'Pacientes')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-person-heart me-2" style="color:#0d6efd;"></i>Pacientes</h1>
    @if(auth()->user()->esAdmin() || auth()->user()->esRecepcionista())
    <a href="{{ route('pacientes.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Nuevo Paciente</a>
    @endif
</div>

<div class="table-card">
    <div class="table-header">
        <form class="d-flex gap-2" method="GET" action="{{ route('pacientes.index') }}">
            <input type="text" name="buscar" class="form-control" style="max-width:280px;font-size:0.85rem;" placeholder="Buscar por nombre, CURP o teléfono..." value="{{ request('buscar') }}">
            <button class="btn btn-outline-secondary btn-sm px-3" type="submit"><i class="bi bi-search"></i></button>
            @if(request('buscar'))<a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary btn-sm px-3"><i class="bi bi-x-lg"></i></a>@endif
        </form>
        <small class="text-muted">{{ $pacientes->total() }} registros</small>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Paciente</th><th>Sexo</th><th>Fecha Nac.</th><th>CURP</th><th>Teléfono</th><th>Estado</th><th class="text-center">Acciones</th></tr></thead>
            <tbody>
                @forelse($pacientes as $paciente)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:36px;height:36px;border-radius:50%;background:{{ $paciente->sexo === 'Masculino' ? 'linear-gradient(135deg,#0d6efd,#0dcaf0)' : 'linear-gradient(135deg,#e91e8c,#f06292)' }};display:flex;align-items:center;justify-content:center;color:white;font-size:0.75rem;font-weight:700;flex-shrink:0;">
                                {{ strtoupper(substr($paciente->nombre, 0, 1) . substr($paciente->apellido_paterno, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:0.875rem;">{{ $paciente->nombre_completo }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $paciente->sexo === 'Masculino' ? 'bg-primary-subtle text-primary border border-primary-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }}" style="font-size:0.72rem;border-radius:6px;">
                            <i class="bi bi-{{ $paciente->sexo === 'Masculino' ? 'gender-male' : 'gender-female' }}"></i> {{ $paciente->sexo }}
                        </span>
                    </td>
                    <td style="font-size:0.83rem;color:#64748b;">{{ $paciente->fecha_nacimiento ? $paciente->fecha_nacimiento->format('d/m/Y') : '—' }}</td>
                    <td style="font-size:0.78rem;color:#64748b;font-family:monospace;">{{ $paciente->curp ?? '—' }}</td>
                    <td style="font-size:0.83rem;color:#64748b;">{{ $paciente->telefono ?? '—' }}</td>
                    <td style="font-size:0.83rem;color:#64748b;">{{ $paciente->estado ?? '—' }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('pacientes.show', $paciente) }}" class="btn btn-sm btn-outline-info btn-icon" title="Ver"><i class="bi bi-eye"></i></a>
                            @if(auth()->user()->esAdmin() || auth()->user()->esRecepcionista())
                            <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-sm btn-outline-warning btn-icon" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                            @endif
                            @if(auth()->user()->esAdmin())
                            <form method="POST" action="{{ route('pacientes.destroy', $paciente) }}" class="d-inline" onsubmit="return confirm('¿Eliminar al paciente {{ $paciente->nombre_completo }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger btn-icon" title="Eliminar"><i class="bi bi-trash-fill"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4"><i class="bi bi-person-x fs-3 d-block mb-2 opacity-25"></i>No se encontraron pacientes</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pacientes->hasPages())<div class="px-3 py-2 border-top">{{ $pacientes->links() }}</div>@endif
</div>
@endsection
