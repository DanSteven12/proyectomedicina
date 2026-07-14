@extends('layouts.app')
@section('titulo', 'Nuevo Doctor')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-person-badge-fill me-2" style="color:#0d6efd;"></i>Nuevo Doctor</h1>
    <a href="{{ route('doctores.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="form-card">
            <form method="POST" action="{{ route('doctores.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">Usuario <span class="text-danger">*</span></label>
                        <select id="user_id" name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                            <option value="">Seleccionar usuario...</option>
                            @foreach($usuarios as $u)
                                <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="especialidad_id" class="form-label">Especialidad <span class="text-danger">*</span></label>
                        <select id="especialidad_id" name="especialidad_id" class="form-select @error('especialidad_id') is-invalid @enderror" required>
                            <option value="">Seleccionar especialidad...</option>
                            @foreach($especialidades as $esp)
                                <option value="{{ $esp->id }}" {{ old('especialidad_id') == $esp->id ? 'selected' : '' }}>{{ $esp->nombre }}</option>
                            @endforeach
                        </select>
                        @error('especialidad_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre(s) <span class="text-danger">*</span></label>
                        <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control @error('apellido_paterno') is-invalid @enderror" value="{{ old('apellido_paterno') }}" required>
                        @error('apellido_paterno')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                        <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="{{ old('apellido_materno') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="cedula_profesional" class="form-label">Cédula Profesional <span class="text-danger">*</span></label>
                        <input type="text" id="cedula_profesional" name="cedula_profesional" class="form-control @error('cedula_profesional') is-invalid @enderror" value="{{ old('cedula_profesional') }}" required>
                        @error('cedula_profesional')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono') }}" maxlength="15">
                    </div>
                    <div class="col-md-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" id="correo" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" placeholder="doctor@ejemplo.com">
                        @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 d-flex gap-2 pt-1">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Guardar</button>
                        <a href="{{ route('doctores.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
