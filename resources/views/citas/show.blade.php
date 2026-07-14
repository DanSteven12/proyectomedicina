@extends('layouts.app')
@section('titulo', 'Detalle de Cita')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-calendar2-check-fill me-2" style="color:#0d6efd;"></i>Detalle de Cita</h1>
    <div class="d-flex gap-2">
        @if(auth()->user()->esAdmin() || auth()->user()->esRecepcionista())
        <a href="{{ route('citas.edit', $cita) }}" class="btn btn-outline-warning"><i class="bi bi-pencil me-1"></i>Editar</a>
        @endif
        <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="form-card h-100">
            <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                <i class="bi bi-calendar2-fill me-2 text-primary"></i>Información de la Cita
            </h6>
            <dl class="row mb-0" style="font-size:0.875rem;">
                <dt class="col-5 text-muted fw-normal">Paciente</dt>
                <dd class="col-7 fw-semibold">
                    <a href="{{ route('pacientes.show', $cita->paciente) }}" style="text-decoration:none;color:inherit;">{{ $cita->paciente->nombre_completo ?? '—' }}</a>
                </dd>
                <dt class="col-5 text-muted fw-normal">Doctor</dt>
                <dd class="col-7">{{ $cita->doctor->nombre_completo ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Especialidad</dt>
                <dd class="col-7">{{ $cita->doctor->especialidad->nombre ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Fecha</dt>
                <dd class="col-7">{{ $cita->fecha->format('d/m/Y') }}</dd>
                <dt class="col-5 text-muted fw-normal">Hora</dt>
                <dd class="col-7">{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</dd>
                <dt class="col-5 text-muted fw-normal">Estado</dt>
                <dd class="col-7">
                    @php $ec = ['Pendiente'=>'warning','Confirmada'=>'success','Cancelada'=>'danger','Finalizada'=>'secondary']; $c = $ec[$cita->estado] ?? 'secondary'; @endphp
                    <span class="badge bg-{{ $c }}-subtle text-{{ $c }} border border-{{ $c }}-subtle" style="font-size:0.75rem;border-radius:6px;">{{ $cita->estado }}</span>
                </dd>
                <dt class="col-5 text-muted fw-normal">Motivo</dt>
                <dd class="col-7">{{ $cita->motivo }}</dd>
                <dt class="col-5 text-muted fw-normal">Observaciones</dt>
                <dd class="col-7">{{ $cita->observaciones ?? '—' }}</dd>
            </dl>
        </div>
    </div>

    <div class="col-md-6">
        @if($cita->consulta)
        <div class="form-card h-100">
            <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                <i class="bi bi-file-medical-fill me-2 text-success"></i>Consulta Registrada
            </h6>
            <dl class="row mb-3" style="font-size:0.875rem;">
                <dt class="col-5 text-muted fw-normal">Diagnóstico</dt>
                <dd class="col-7">{{ $cita->consulta->diagnostico ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Tratamiento</dt>
                <dd class="col-7">{{ $cita->consulta->tratamiento ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Peso</dt>
                <dd class="col-7">{{ $cita->consulta->peso ? $cita->consulta->peso . ' kg' : '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Talla</dt>
                <dd class="col-7">{{ $cita->consulta->talla ? $cita->consulta->talla . ' cm' : '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Temperatura</dt>
                <dd class="col-7">{{ $cita->consulta->temperatura ? $cita->consulta->temperatura . ' °C' : '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Presión Arterial</dt>
                <dd class="col-7">{{ $cita->consulta->presion_arterial ?? '—' }}</dd>
            </dl>
            <a href="{{ route('consultas.show', $cita->consulta) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-eye me-1"></i>Ver Consulta Completa
            </a>
        </div>
        @elseif(auth()->user()->esAdmin() || auth()->user()->esDoctor())
        <div class="form-card h-100 d-flex align-items-center justify-content-center flex-column text-center" style="min-height:200px;">
            <i class="bi bi-file-medical fs-2 text-muted opacity-25 mb-3"></i>
            <p class="text-muted mb-3" style="font-size:0.875rem;">No hay consulta registrada para esta cita.</p>
            @if($cita->estado === 'Confirmada')
            <a href="{{ route('consultas.create') }}?cita_id={{ $cita->id }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i>Registrar Consulta
            </a>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
