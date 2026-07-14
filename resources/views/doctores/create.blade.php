@extends('layouts.app')
@section('titulo', 'Nuevo Doctor')

@section('contenido')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        padding: 2.5rem;
    }
    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.2);
    }
    .page-title {
        font-weight: 700;
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0;
    }
    .form-floating > .form-control,
    .form-floating > .form-select {
        border-radius: 0.75rem;
        border: 1px solid #ced4da;
        background-color: rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
    }
    .form-floating > .form-control:focus,
    .form-floating > .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        background-color: #fff;
    }
    .btn-premium {
        border-radius: 0.75rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-premium-primary {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        border: none;
        color: white;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
    }
    .btn-premium-primary:hover {
        background: linear-gradient(135deg, #0a58ca, #084298);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        color: white;
    }
    .btn-premium-secondary {
        background: transparent;
        border: 2px solid #6c757d;
        color: #6c757d;
    }
    .btn-premium-secondary:hover {
        background: #6c757d;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
    }
    .icon-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        margin-right: 1rem;
        font-size: 1.5rem;
    }
    .form-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid rgba(13, 110, 253, 0.1);
    }
    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container py-4 fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="icon-circle">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h1 class="page-title">Nuevo Doctor</h1>
        </div>
        <a href="{{ route('doctores.index') }}" class="btn btn-premium btn-premium-secondary d-flex align-items-center">
            <i class="bi bi-arrow-left me-2"></i> Regresar
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card">
                <form method="POST" action="{{ route('doctores.store') }}" class="needs-validation" novalidate>
                    @csrf
                    
                    <div class="form-section-title">
                        <i class="bi bi-shield-lock me-2"></i>Información de Cuenta
                    </div>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select id="user_id" name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Seleccione un usuario</option>
                                    @foreach($usuarios as $u)
                                        <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                                    @endforeach
                                </select>
                                <label for="user_id">Usuario Vinculado <span class="text-danger">*</span></label>
                                @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select id="especialidad_id" name="especialidad_id" class="form-select @error('especialidad_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Seleccione una especialidad</option>
                                    @foreach($especialidades as $esp)
                                        <option value="{{ $esp->id }}" {{ old('especialidad_id') == $esp->id ? 'selected' : '' }}>{{ $esp->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="especialidad_id">Especialidad Médica <span class="text-danger">*</span></label>
                                @error('especialidad_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-section-title mt-5">
                        <i class="bi bi-person-lines-fill me-2"></i>Datos Personales y Profesionales
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Nombre(s)" required>
                                <label for="nombre">Nombre(s) <span class="text-danger">*</span></label>
                                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control @error('apellido_paterno') is-invalid @enderror" value="{{ old('apellido_paterno') }}" placeholder="Apellido Paterno" required>
                                <label for="apellido_paterno">Apellido Paterno <span class="text-danger">*</span></label>
                                @error('apellido_paterno')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="{{ old('apellido_materno') }}" placeholder="Apellido Materno">
                                <label for="apellido_materno">Apellido Materno</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" id="cedula_profesional" name="cedula_profesional" class="form-control @error('cedula_profesional') is-invalid @enderror" value="{{ old('cedula_profesional') }}" placeholder="Cédula" required>
                                <label for="cedula_profesional">Cédula Profesional <span class="text-danger">*</span></label>
                                @error('cedula_profesional')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="tel" id="telefono" name="telefono" class="form-control" value="{{ old('telefono') }}" placeholder="Teléfono" maxlength="15">
                                <label for="telefono">Teléfono de Contacto</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="email" id="correo" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" placeholder="Correo">
                                <label for="correo">Correo Electrónico</label>
                                @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top">
                        <a href="{{ route('doctores.index') }}" class="btn btn-premium btn-premium-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-premium btn-premium-primary d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2"></i> Guardar Doctor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection
