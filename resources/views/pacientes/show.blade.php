@extends('layouts.app')
@section('titulo', 'Detalle del Paciente')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-person-fill me-2" style="color:#0d6efd;"></i>{{ $paciente->nombre_completo }}</h1>
    <div class="d-flex gap-2">
        @if(auth()->user()->esAdmin() || auth()->user()->esRecepcionista())
        <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-outline-warning"><i class="bi bi-pencil me-1"></i>Editar</a>
        @endif
        <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-5">
        <div class="form-card h-100">
            <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                <i class="bi bi-person-fill me-2 text-primary"></i>Información Personal
            </h6>
            <dl class="row mb-0" style="font-size:0.875rem;">
                <dt class="col-5 text-muted fw-normal">Nombre</dt>
                <dd class="col-7 fw-semibold">{{ $paciente->nombre_completo }}</dd>
                <dt class="col-5 text-muted fw-normal">Sexo</dt>
                <dd class="col-7">
                    <span class="badge {{ $paciente->sexo === 'Masculino' ? 'bg-primary-subtle text-primary' : 'bg-danger-subtle text-danger' }}" style="border-radius:6px;font-size:0.72rem;">{{ $paciente->sexo }}</span>
                </dd>
                <dt class="col-5 text-muted fw-normal">Fecha Nac.</dt>
                <dd class="col-7">{{ $paciente->fecha_nacimiento ? $paciente->fecha_nacimiento->format('d/m/Y') : '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">CURP</dt>
                <dd class="col-7" style="font-family:monospace;font-size:0.8rem;">{{ $paciente->curp ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Teléfono</dt>
                <dd class="col-7">{{ $paciente->telefono ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Correo</dt>
                <dd class="col-7" style="word-break:break-all;">{{ $paciente->correo ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Dirección</dt>
                <dd class="col-7">{{ $paciente->direccion ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">C.P.</dt>
                <dd class="col-7">{{ $paciente->codigo_postal ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Estado</dt>
                <dd class="col-7">{{ $paciente->estado ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Municipio</dt>
                <dd class="col-7">{{ $paciente->municipio ?? '—' }}</dd>
            </dl>
        </div>
    </div>

    <div class="col-md-7">
        <div class="table-card">
            <div class="table-header">
                <h6 class="mb-0 fw-semibold" style="color:#1a2c42;"><i class="bi bi-calendar2-check-fill me-2 text-primary"></i>Historial de Citas</h6>
                @if(auth()->user()->esAdmin() || auth()->user()->esRecepcionista())
                <a href="{{ route('citas.create') }}" class="btn btn-sm btn-primary" style="border-radius:8px;font-size:0.8rem;">
                    <i class="bi bi-plus me-1"></i>Nueva Cita
                </a>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead><tr><th>Fecha</th><th>Doctor</th><th>Motivo</th><th>Estado</th><th>Consulta</th></tr></thead>
                    <tbody>
                        @forelse($paciente->citas as $cita)
                        <tr>
                            <td style="font-size:0.83rem;">{{ $cita->fecha->format('d/m/Y') }} {{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>
                            <td style="font-size:0.83rem;">{{ $cita->doctor->nombre_completo ?? '—' }}</td>
                            <td style="font-size:0.83rem;max-width:150px;">{{ Str::limit($cita->motivo, 50) }}</td>
                            <td>
                                @php $ec = ['Pendiente'=>'warning','Confirmada'=>'success','Cancelada'=>'danger','Finalizada'=>'secondary']; $c = $ec[$cita->estado] ?? 'secondary'; @endphp
                                <span class="badge bg-{{ $c }}-subtle text-{{ $c }} border border-{{ $c }}-subtle" style="font-size:0.7rem;border-radius:6px;">{{ $cita->estado }}</span>
                            </td>
                            <td>
                                @if($cita->consulta)
                                <a href="{{ route('consultas.show', $cita->consulta) }}" class="btn btn-sm btn-outline-info btn-icon" title="Ver consulta"><i class="bi bi-file-medical"></i></a>
                                @else
                                <span class="text-muted" style="font-size:0.75rem;">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3" style="font-size:0.85rem;"><i class="bi bi-calendar-x me-1"></i>Sin citas registradas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
