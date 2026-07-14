@extends('layouts.app')
@section('titulo', 'Editar Cita')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-calendar2-fill me-2" style="color:#0d6efd;"></i>Editar Cita</h1>
    <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="form-card">
            <form method="POST" action="{{ route('citas.update', $cita) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="paciente_id" class="form-label">Paciente <span class="text-danger">*</span></label>
                        <select id="paciente_id" name="paciente_id" class="form-select @error('paciente_id') is-invalid @enderror" required>
                            @foreach($pacientes as $p)
                                <option value="{{ $p->id }}" {{ old('paciente_id', $cita->paciente_id) == $p->id ? 'selected' : '' }}>{{ $p->nombre_completo }}</option>
                            @endforeach
                        </select>
                        @error('paciente_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="doctor_id" class="form-label">Doctor <span class="text-danger">*</span></label>
                        <select id="doctor_id" name="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" required>
                            @foreach($doctores as $d)
                                <option value="{{ $d->id }}" {{ old('doctor_id', $cita->doctor_id) == $d->id ? 'selected' : '' }}>{{ $d->nombre_completo }} — {{ $d->especialidad->nombre ?? '' }}</option>
                            @endforeach
                        </select>
                        @error('doctor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="fecha" class="form-label">Fecha <span class="text-danger">*</span></label>
                        <input type="date" id="fecha" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $cita->fecha->format('Y-m-d')) }}" required>
                        @error('fecha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="hora" class="form-label">Hora <span class="text-danger">*</span></label>
                        <input type="time" id="hora" name="hora" class="form-control @error('hora') is-invalid @enderror" value="{{ old('hora', \Carbon\Carbon::parse($cita->hora)->format('H:i')) }}" required>
                        @error('hora')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                        <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                            @foreach(['Pendiente','Confirmada','Cancelada','Finalizada'] as $e)
                                <option value="{{ $e }}" {{ old('estado', $cita->estado) === $e ? 'selected' : '' }}>{{ $e }}</option>
                            @endforeach
                        </select>
                        @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label for="motivo" class="form-label">Motivo <span class="text-danger">*</span></label>
                        <textarea id="motivo" name="motivo" class="form-control @error('motivo') is-invalid @enderror" rows="3" required>{{ old('motivo', $cita->motivo) }}</textarea>
                        @error('motivo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea id="observaciones" name="observaciones" class="form-control" rows="2">{{ old('observaciones', $cita->observaciones) }}</textarea>
                    </div>
                    <div class="col-12 d-flex gap-2 pt-1">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Actualizar</button>
                        <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
