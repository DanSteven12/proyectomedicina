@extends('layouts.app')
@section('titulo', 'Nueva Consulta')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-file-medical-fill me-2" style="color:#0d6efd;"></i>Nueva Consulta</h1>
    <a href="{{ route('consultas.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="form-card">
            <form method="POST" action="{{ route('consultas.store') }}">
                @csrf

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-calendar2-check-fill me-2 text-primary"></i>Cita Médica
                </h6>

                <div class="mb-4">
                    <label for="cita_id" class="form-label">Cita <span class="text-danger">*</span></label>
                    <select id="cita_id" name="cita_id" class="form-select @error('cita_id') is-invalid @enderror" required>
                        <option value="">Seleccionar cita...</option>
                        @foreach($citas as $cita)
                            <option value="{{ $cita->id }}" {{ (old('cita_id', request('cita_id'))) == $cita->id ? 'selected' : '' }}>
                                {{ $cita->paciente->nombre_completo ?? '—' }} — {{ $cita->doctor->nombre_completo ?? '—' }} — {{ $cita->fecha->format('d/m/Y') }} {{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}
                            </option>
                        @endforeach
                    </select>
                    @error('cita_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @if($citas->isEmpty())
                    <div class="form-text text-warning"><i class="bi bi-exclamation-triangle me-1"></i>No hay citas confirmadas disponibles sin consulta registrada.</div>
                    @endif
                </div>

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-activity me-2 text-primary"></i>Signos Vitales
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label for="peso" class="form-label">Peso (kg)</label>
                        <input type="number" step="0.01" id="peso" name="peso" class="form-control @error('peso') is-invalid @enderror" value="{{ old('peso') }}" placeholder="Ej: 70.50">
                        @error('peso')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="talla" class="form-label">Talla (cm)</label>
                        <input type="number" step="0.01" id="talla" name="talla" class="form-control @error('talla') is-invalid @enderror" value="{{ old('talla') }}" placeholder="Ej: 170.00">
                        @error('talla')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="temperatura" class="form-label">Temperatura (°C)</label>
                        <input type="number" step="0.01" id="temperatura" name="temperatura" class="form-control @error('temperatura') is-invalid @enderror" value="{{ old('temperatura') }}" placeholder="Ej: 36.5">
                        @error('temperatura')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="presion_arterial" class="form-label">Presión Arterial</label>
                        <input type="text" id="presion_arterial" name="presion_arterial" class="form-control" value="{{ old('presion_arterial') }}" placeholder="Ej: 120/80">
                    </div>
                </div>

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-clipboard2-pulse-fill me-2 text-primary"></i>Diagnóstico y Tratamiento
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label for="diagnostico" class="form-label">Diagnóstico</label>
                        <textarea id="diagnostico" name="diagnostico" class="form-control" rows="3" placeholder="Diagnóstico médico...">{{ old('diagnostico') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="tratamiento" class="form-label">Tratamiento</label>
                        <textarea id="tratamiento" name="tratamiento" class="form-control" rows="3" placeholder="Plan de tratamiento...">{{ old('tratamiento') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="receta" class="form-label">Receta</label>
                        <textarea id="receta" name="receta" class="form-control" rows="4" placeholder="Medicamentos prescritos, dosis, frecuencia...">{{ old('receta') }}</textarea>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Guardar Consulta</button>
                    <a href="{{ route('consultas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
