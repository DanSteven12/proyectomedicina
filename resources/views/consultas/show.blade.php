@extends('layouts.app')
@section('titulo', 'Detalle de Consulta')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-file-medical-fill me-2" style="color:#0d6efd;"></i>Detalle de Consulta</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('consultas.edit', $consulta) }}" class="btn btn-outline-warning"><i class="bi bi-pencil me-1"></i>Editar</a>
        <a href="{{ route('consultas.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-5">
        <div class="form-card mb-3">
            <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                <i class="bi bi-calendar2-fill me-2 text-primary"></i>Datos de la Cita
            </h6>
            <dl class="row mb-0" style="font-size:0.875rem;">
                <dt class="col-5 text-muted fw-normal">Paciente</dt>
                <dd class="col-7 fw-semibold">
                    <a href="{{ route('pacientes.show', $consulta->cita->paciente) }}" style="text-decoration:none;color:inherit;">{{ $consulta->cita->paciente->nombre_completo ?? '—' }}</a>
                </dd>
                <dt class="col-5 text-muted fw-normal">Doctor</dt>
                <dd class="col-7">{{ $consulta->cita->doctor->nombre_completo ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Especialidad</dt>
                <dd class="col-7">{{ $consulta->cita->doctor->especialidad->nombre ?? '—' }}</dd>
                <dt class="col-5 text-muted fw-normal">Fecha</dt>
                <dd class="col-7">{{ $consulta->cita->fecha->format('d/m/Y') }}</dd>
                <dt class="col-5 text-muted fw-normal">Hora</dt>
                <dd class="col-7">{{ \Carbon\Carbon::parse($consulta->cita->hora)->format('H:i') }}</dd>
            </dl>
        </div>

        <div class="form-card">
            <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                <i class="bi bi-activity me-2 text-danger"></i>Signos Vitales
            </h6>
            <div class="row g-2">
                @php
                    $vitales = [
                        ['label'=>'Peso','valor'=>$consulta->peso ? $consulta->peso.' kg' : '—','icon'=>'bi-box','color'=>'primary'],
                        ['label'=>'Talla','valor'=>$consulta->talla ? $consulta->talla.' cm' : '—','icon'=>'bi-rulers','color'=>'success'],
                        ['label'=>'Temperatura','valor'=>$consulta->temperatura ? $consulta->temperatura.' °C' : '—','icon'=>'bi-thermometer-half','color'=>'danger'],
                        ['label'=>'Presión Arterial','valor'=>$consulta->presion_arterial ?? '—','icon'=>'bi-heart-pulse-fill','color'=>'warning'],
                    ];
                @endphp
                @foreach($vitales as $v)
                <div class="col-6">
                    <div style="background:#f8fafc;border-radius:10px;padding:0.75rem;text-align:center;">
                        <i class="bi {{ $v['icon'] }} text-{{ $v['color'] }}" style="font-size:1.2rem;"></i>
                        <div style="font-size:0.75rem;color:#64748b;margin-top:0.25rem;">{{ $v['label'] }}</div>
                        <div style="font-size:0.9rem;font-weight:600;color:#1a2c42;">{{ $v['valor'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="form-card h-100">
            <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                <i class="bi bi-clipboard2-pulse-fill me-2 text-primary"></i>Diagnóstico y Tratamiento
            </h6>

            <div class="mb-3">
                <label class="form-label text-muted" style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;">Diagnóstico</label>
                <div style="background:#f8fafc;border-radius:10px;padding:0.875rem;font-size:0.875rem;min-height:80px;white-space:pre-wrap;">{{ $consulta->diagnostico ?? 'No registrado.' }}</div>
            </div>
            <div class="mb-3">
                <label class="form-label text-muted" style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;">Tratamiento</label>
                <div style="background:#f8fafc;border-radius:10px;padding:0.875rem;font-size:0.875rem;min-height:80px;white-space:pre-wrap;">{{ $consulta->tratamiento ?? 'No registrado.' }}</div>
            </div>
            <div class="mb-3">
                <label class="form-label text-muted" style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;">Receta</label>
                <div style="background:#f8fafc;border-radius:10px;padding:0.875rem;font-size:0.875rem;min-height:80px;white-space:pre-wrap;font-family:monospace;">{{ $consulta->receta ?? 'Sin receta.' }}</div>
            </div>

            <div class="text-muted" style="font-size:0.75rem;border-top:1px solid #f0f4f8;padding-top:0.75rem;">
                <i class="bi bi-clock me-1"></i>Registrado: {{ $consulta->created_at->format('d/m/Y H:i') }}
                @if($consulta->updated_at->ne($consulta->created_at))
                  | <i class="bi bi-pencil me-1"></i>Actualizado: {{ $consulta->updated_at->format('d/m/Y H:i') }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
