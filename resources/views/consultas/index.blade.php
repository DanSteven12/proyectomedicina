@extends('layouts.app')
@section('titulo', 'Consultas')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-file-medical-fill me-2" style="color:#0d6efd;"></i>Consultas</h1>
    <a href="{{ route('consultas.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Nueva Consulta</a>
</div>

<div class="table-card">
    <div class="table-header">
        <form class="d-flex gap-2" method="GET" action="{{ route('consultas.index') }}">
            <input type="text" name="buscar" class="form-control" style="max-width:260px;font-size:0.85rem;" placeholder="Buscar por paciente..." value="{{ request('buscar') }}">
            <button class="btn btn-outline-secondary btn-sm px-3" type="submit"><i class="bi bi-search"></i></button>
            @if(request('buscar'))<a href="{{ route('consultas.index') }}" class="btn btn-outline-secondary btn-sm px-3"><i class="bi bi-x-lg"></i></a>@endif
        </form>
        <small class="text-muted">{{ $consultas->total() }} registros</small>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Paciente</th><th>Doctor</th><th>Fecha Cita</th><th>Diagnóstico</th><th>Signos Vitales</th><th class="text-center">Acciones</th></tr></thead>
            <tbody>
                @forelse($consultas as $consulta)
                <tr>
                    <td>
                        <div class="fw-semibold" style="font-size:0.875rem;">{{ $consulta->cita->paciente->nombre_completo ?? '—' }}</div>
                    </td>
                    <td style="font-size:0.83rem;color:#64748b;">{{ $consulta->cita->doctor->nombre_completo ?? '—' }}</td>
                    <td style="font-size:0.83rem;">{{ $consulta->cita->fecha->format('d/m/Y') }}</td>
                    <td style="font-size:0.83rem;max-width:200px;color:#64748b;">{{ Str::limit($consulta->diagnostico, 50) ?? '—' }}</td>
                    <td>
                        <div style="font-size:0.75rem;color:#64748b;">
                            @if($consulta->peso)<span class="badge bg-light text-dark border me-1">{{ $consulta->peso }}kg</span>@endif
                            @if($consulta->temperatura)<span class="badge bg-light text-dark border">{{ $consulta->temperatura }}°C</span>@endif
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('consultas.show', $consulta) }}" class="btn btn-sm btn-outline-info btn-icon" title="Ver"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('consultas.edit', $consulta) }}" class="btn btn-sm btn-outline-warning btn-icon" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                            @if(auth()->user()->esAdmin())
                            <form method="POST" action="{{ route('consultas.destroy', $consulta) }}" class="d-inline" onsubmit="return confirm('¿Eliminar esta consulta? La cita volverá a estado Confirmada.')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger btn-icon" title="Eliminar"><i class="bi bi-trash-fill"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4"><i class="bi bi-file-x fs-3 d-block mb-2 opacity-25"></i>No se encontraron consultas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($consultas->hasPages())<div class="px-3 py-2 border-top">{{ $consultas->links() }}</div>@endif
</div>
@endsection
