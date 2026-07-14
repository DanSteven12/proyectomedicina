@extends('layouts.app')
@section('titulo', 'Citas')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-calendar2-check-fill me-2" style="color:#0d6efd;"></i>Citas</h1>
    @if(auth()->user()->esAdmin() || auth()->user()->esRecepcionista())
    <a href="{{ route('citas.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Nueva Cita</a>
    @endif
</div>

<div class="table-card mb-3">
    <div class="table-header" style="flex-wrap:wrap;gap:0.5rem;">
        <form class="d-flex gap-2 flex-wrap" method="GET" action="{{ route('citas.index') }}">
            <input type="text" name="buscar" class="form-control" style="max-width:220px;font-size:0.85rem;" placeholder="Buscar paciente..." value="{{ request('buscar') }}">
            <select name="estado" class="form-select" style="max-width:160px;font-size:0.85rem;">
                <option value="">Todos los estados</option>
                @foreach(['Pendiente','Confirmada','Cancelada','Finalizada'] as $e)
                    <option value="{{ $e }}" {{ request('estado') === $e ? 'selected' : '' }}>{{ $e }}</option>
                @endforeach
            </select>
            <input type="date" name="fecha" class="form-control" style="max-width:170px;font-size:0.85rem;" value="{{ request('fecha') }}">
            <button class="btn btn-outline-secondary btn-sm px-3" type="submit"><i class="bi bi-search"></i></button>
            @if(request()->anyFilled(['buscar','estado','fecha']))
                <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary btn-sm px-3"><i class="bi bi-x-lg"></i></a>
            @endif
        </form>
        <small class="text-muted">{{ $citas->total() }} registros</small>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Paciente</th><th>Doctor</th><th>Fecha</th><th>Hora</th><th>Motivo</th><th>Estado</th><th class="text-center">Acciones</th></tr></thead>
            <tbody>
                @forelse($citas as $cita)
                <tr>
                    <td>
                        <div class="fw-semibold" style="font-size:0.875rem;">{{ $cita->paciente->nombre_completo ?? '—' }}</div>
                    </td>
                    <td style="font-size:0.83rem;color:#64748b;">{{ $cita->doctor->nombre_completo ?? '—' }}</td>
                    <td style="font-size:0.83rem;">{{ $cita->fecha->format('d/m/Y') }}</td>
                    <td style="font-size:0.83rem;">{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>
                    <td style="font-size:0.83rem;max-width:150px;color:#64748b;">{{ Str::limit($cita->motivo, 40) }}</td>
                    <td>
                        @php $ec = ['Pendiente'=>'warning','Confirmada'=>'success','Cancelada'=>'danger','Finalizada'=>'secondary']; $c = $ec[$cita->estado] ?? 'secondary'; @endphp
                        <span class="badge bg-{{ $c }}-subtle text-{{ $c }} border border-{{ $c }}-subtle" style="font-size:0.72rem;border-radius:6px;">{{ $cita->estado }}</span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('citas.show', $cita) }}" class="btn btn-sm btn-outline-info btn-icon" title="Ver"><i class="bi bi-eye"></i></a>
                            @if(auth()->user()->esAdmin() || auth()->user()->esRecepcionista())
                            <a href="{{ route('citas.edit', $cita) }}" class="btn btn-sm btn-outline-warning btn-icon" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                            @endif
                            @if(auth()->user()->esAdmin() && $cita->estado !== 'Finalizada')
                            <form method="POST" action="{{ route('citas.destroy', $cita) }}" class="d-inline" onsubmit="return confirm('¿Eliminar esta cita?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger btn-icon" title="Eliminar"><i class="bi bi-trash-fill"></i></button>
                            </form>
                            @endif
                            @if((auth()->user()->esAdmin() || auth()->user()->esDoctor()) && $cita->estado === 'Confirmada' && !$cita->consulta)
                            <a href="{{ route('consultas.create') }}?cita_id={{ $cita->id }}" class="btn btn-sm btn-outline-success btn-icon" title="Registrar Consulta"><i class="bi bi-file-medical-fill"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4"><i class="bi bi-calendar-x fs-3 d-block mb-2 opacity-25"></i>No se encontraron citas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($citas->hasPages())<div class="px-3 py-2 border-top">{{ $citas->links() }}</div>@endif
</div>
@endsection
