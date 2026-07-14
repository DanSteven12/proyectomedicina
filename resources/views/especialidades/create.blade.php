@extends('layouts.app')
@section('titulo', 'Nueva Especialidad')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-mortarboard-fill me-2" style="color:#0d6efd;"></i>Nueva Especialidad</h1>
    <a href="{{ route('especialidades.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="form-card">
            <form method="POST" action="{{ route('especialidades.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                    <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Ej: Cardiología" required>
                    @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4" placeholder="Descripción de la especialidad...">{{ old('descripcion') }}</textarea>
                    @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Guardar</button>
                    <a href="{{ route('especialidades.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
