@extends('layouts.app')

@section('titulo', 'Nuevo Usuario')

@section('contenido')
<div class="container-fluid py-4">

    {{-- Encabezado de la página --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="page-title mb-1">
                <i class="bi bi-person-plus-fill me-2"></i>
                Nuevo Usuario
            </h1>
            <p class="text-muted mb-0">
                Registra un nuevo usuario y asigna sus credenciales de acceso.
            </p>
        </div>

        <a href="{{ route('usuarios.index') }}" class="btn btn-light border shadow-sm">
            <i class="bi bi-arrow-left me-2"></i>
            Regresar
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9">

            <div class="card user-form-card border-0">

                {{-- Encabezado de la tarjeta --}}
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <div class="header-icon">
                            <i class="bi bi-person-vcard-fill"></i>
                        </div>

                        <div>
                            <h5 class="mb-1 fw-bold">Información del usuario</h5>
                            <small class="text-muted">
                                Los campos marcados con
                                <span class="text-danger">*</span>
                                son obligatorios.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf

                        <div class="row g-4">

                            {{-- Nombre completo --}}
                            <div class="col-12">
                                <label for="name" class="form-label">
                                    Nombre completo
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group custom-input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>

                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}"
                                        placeholder="Ejemplo: Alex Fernando Demeza"
                                        autocomplete="name"
                                        required
                                        autofocus
                                    >

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Correo electrónico --}}
                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    Correo electrónico
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group custom-input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}"
                                        placeholder="correo@ejemplo.com"
                                        autocomplete="email"
                                        required
                                    >

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Rol --}}
                            <div class="col-md-6">
                                <label for="role_id" class="form-label">
                                    Rol del usuario
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group custom-input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-shield-check"></i>
                                    </span>

                                    <select
                                        id="role_id"
                                        name="role_id"
                                        class="form-select @error('role_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="" selected disabled>
                                            Selecciona un rol
                                        </option>

                                        @foreach($roles as $rol)
                                            <option
                                                value="{{ $rol->id }}"
                                                {{ old('role_id') == $rol->id ? 'selected' : '' }}
                                            >
                                                {{ $rol->nombre }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('role_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Contraseña --}}
                            <div class="col-md-6">
                                <label for="password" class="form-label">
                                    Contraseña
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group custom-input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Mínimo 8 caracteres"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="btn password-button"
                                        onclick="togglePassword('password', 'passwordIcon')"
                                        aria-label="Mostrar u ocultar contraseña"
                                    >
                                        <i class="bi bi-eye" id="passwordIcon"></i>
                                    </button>

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <small class="form-text">
                                    Utiliza letras, números y caracteres especiales.
                                </small>
                            </div>

                            {{-- Confirmar contraseña --}}
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">
                                    Confirmar contraseña
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group custom-input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>

                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Repite la contraseña"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="btn password-button"
                                        onclick="togglePassword(
                                            'password_confirmation',
                                            'confirmationIcon'
                                        )"
                                        aria-label="Mostrar u ocultar confirmación"
                                    >
                                        <i class="bi bi-eye" id="confirmationIcon"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Botones --}}
                            <div class="col-12">
                                <div class="form-actions">
                                    <a
                                        href="{{ route('usuarios.index') }}"
                                        class="btn btn-outline-secondary action-button"
                                    >
                                        <i class="bi bi-x-circle me-2"></i>
                                        Cancelar
                                    </a>

                                    <button
                                        type="submit"
                                        class="btn btn-primary action-button save-button"
                                    >
                                        <i class="bi bi-person-check-fill me-2"></i>
                                        Registrar usuario
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .page-title {
        color: #1e293b;
        font-size: 1.75rem;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .page-title i {
        color: #0d6efd;
    }

    .user-form-card {
        overflow: hidden;
        border-radius: 18px;
        background-color: #ffffff;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.09);
    }

    .user-form-card .card-header {
        padding: 24px 30px;
        background: linear-gradient(135deg, #f8fbff 0%, #eef5ff 100%);
        border-bottom: 1px solid #e9eef5 !important;
    }

    .header-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-right: 15px;
        border-radius: 14px;
        color: #ffffff;
        font-size: 1.4rem;
        background: linear-gradient(135deg, #0d6efd, #3b82f6);
        box-shadow: 0 6px 15px rgba(13, 110, 253, 0.25);
    }

    .form-label {
        color: #334155;
        margin-bottom: 8px;
        font-size: 0.92rem;
        font-weight: 600;
    }

    .custom-input-group {
        border-radius: 11px;
        transition: box-shadow 0.2s ease;
    }

    .custom-input-group:focus-within {
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    .custom-input-group .input-group-text {
        min-width: 47px;
        justify-content: center;
        color: #64748b;
        background-color: #f8fafc;
        border-color: #dce3ec;
        border-radius: 11px 0 0 11px;
    }

    .custom-input-group .form-control,
    .custom-input-group .form-select {
        min-height: 48px;
        color: #1e293b;
        border-color: #dce3ec;
        box-shadow: none;
    }

    .custom-input-group .form-control:focus,
    .custom-input-group .form-select:focus {
        border-color: #86b7fe;
        box-shadow: none;
    }

    .custom-input-group .form-control::placeholder {
        color: #94a3b8;
    }

    .password-button {
        min-width: 48px;
        color: #64748b;
        background-color: #ffffff;
        border: 1px solid #dce3ec;
        border-left: 0;
        border-radius: 0 11px 11px 0;
    }

    .password-button:hover,
    .password-button:focus {
        color: #0d6efd;
        background-color: #f8fafc;
        border-color: #dce3ec;
    }

    .form-text {
        display: block;
        color: #94a3b8;
        margin-top: 7px;
        font-size: 0.78rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 22px;
        margin-top: 5px;
        border-top: 1px solid #edf0f4;
    }

    .action-button {
        min-width: 150px;
        padding: 11px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .save-button {
        border: none;
        background: linear-gradient(135deg, #0d6efd, #2563eb);
        box-shadow: 0 6px 15px rgba(13, 110, 253, 0.22);
    }

    .save-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
    }

    .invalid-feedback {
        font-size: 0.82rem;
    }

    @media (max-width: 576px) {
        .user-form-card .card-header {
            padding: 20px;
        }

        .user-form-card .card-body {
            padding: 22px !important;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .action-button {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (!input || !icon) {
            return;
        }

        const passwordVisible = input.type === 'text';

        input.type = passwordVisible ? 'password' : 'text';

        icon.classList.toggle('bi-eye', passwordVisible);
        icon.classList.toggle('bi-eye-slash', !passwordVisible);
    }
</script>
@endpush