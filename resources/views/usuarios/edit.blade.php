@extends('layouts.app')
@section('titulo', 'Editar Usuario')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-person-fill-gear me-2" style="color:#0d6efd;"></i>Editar Usuario</h1>
    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="form-card">
            <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-12">
                        <label for="name" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $usuario->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $usuario->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="role_id" class="form-label">Rol <span class="text-danger">*</span></label>
                        <select id="role_id" name="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                            <option value="">Seleccionar rol...</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}" {{ old('role_id', $usuario->role_id) == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                            @endforeach
                        </select>
                        @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12"><hr class="my-1"><p class="text-muted" style="font-size:0.8rem;"><i class="bi bi-info-circle me-1"></i>Dejar contraseña vacía para no cambiarla.</p></div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nueva contraseña...">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repetir contraseña...">
                    </div>
                    <div class="col-12 d-flex gap-2 pt-1">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Actualizar</button>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
