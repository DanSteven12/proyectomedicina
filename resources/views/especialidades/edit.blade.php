@extends('layouts.app')
@section('titulo', 'Editar Especialidad')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-mortarboard-fill me-2" style="color:#0d6efd;"></i>Editar Especialidad</h1>
    <a href="{{ route('especialidades.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="form-card">
            <form method="POST" action="{{ route('especialidades.update', $especialidad) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                    <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $especialidad->nombre) }}" required>
                    @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4">{{ old('descripcion', $especialidad->descripcion) }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Actualizar</button>
                    <a href="{{ route('especialidades.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
