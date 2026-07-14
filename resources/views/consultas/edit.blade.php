@extends('layouts.app')
@section('titulo', 'Editar Consulta')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-file-medical-fill me-2" style="color:#0d6efd;"></i>Editar Consulta</h1>
    <a href="{{ route('consultas.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="form-card">
            <div class="alert alert-info d-flex gap-2 mb-4" style="border-radius:10px;border:none;background:rgba(13,202,240,0.12);color:#0891b2;">
                <i class="bi bi-info-circle-fill"></i>
                <div>
                    <strong>Cita:</strong> {{ $consulta->cita->paciente->nombre_completo ?? '—' }} — {{ $consulta->cita->fecha->format('d/m/Y') }} {{ \Carbon\Carbon::parse($consulta->cita->hora)->format('H:i') }}
                    | <strong>Doctor:</strong> {{ $consulta->cita->doctor->nombre_completo ?? '—' }}
                </div>
            </div>
            <form method="POST" action="{{ route('consultas.update', $consulta) }}">
                @csrf @method('PUT')
                <input type="hidden" name="cita_id" value="{{ $consulta->cita_id }}">

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-activity me-2 text-primary"></i>Signos Vitales
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label for="peso" class="form-label">Peso (kg)</label>
                        <input type="number" step="0.01" id="peso" name="peso" class="form-control @error('peso') is-invalid @enderror" value="{{ old('peso', $consulta->peso) }}">
                        @error('peso')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="talla" class="form-label">Talla (cm)</label>
                        <input type="number" step="0.01" id="talla" name="talla" class="form-control @error('talla') is-invalid @enderror" value="{{ old('talla', $consulta->talla) }}">
                        @error('talla')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="temperatura" class="form-label">Temperatura (°C)</label>
                        <input type="number" step="0.01" id="temperatura" name="temperatura" class="form-control @error('temperatura') is-invalid @enderror" value="{{ old('temperatura', $consulta->temperatura) }}">
                        @error('temperatura')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="presion_arterial" class="form-label">Presión Arterial</label>
                        <input type="text" id="presion_arterial" name="presion_arterial" class="form-control" value="{{ old('presion_arterial', $consulta->presion_arterial) }}" placeholder="Ej: 120/80">
                    </div>
                </div>

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-clipboard2-pulse-fill me-2 text-primary"></i>Diagnóstico y Tratamiento
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label for="diagnostico" class="form-label">Diagnóstico</label>
                        <textarea id="diagnostico" name="diagnostico" class="form-control" rows="3">{{ old('diagnostico', $consulta->diagnostico) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="tratamiento" class="form-label">Tratamiento</label>
                        <textarea id="tratamiento" name="tratamiento" class="form-control" rows="3">{{ old('tratamiento', $consulta->tratamiento) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="receta" class="form-label">Receta</label>
                        <textarea id="receta" name="receta" class="form-control" rows="4">{{ old('receta', $consulta->receta) }}</textarea>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Actualizar</button>
                    <a href="{{ route('consultas.show', $consulta) }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
