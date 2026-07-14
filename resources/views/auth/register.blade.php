<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Registro - Sistema de Gestión de Citas Médicas">
    <title>Registro | SaludSystem</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #0f1c2e;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
        }

        body::before {
            content: '';
            position: fixed;
            top: -40%;
            left: -20%;
            width: 70%;
            height: 120%;
            background: radial-gradient(ellipse, rgba(13,110,253,0.15) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -30%;
            right: -10%;
            width: 60%;
            height: 80%;
            background: radial-gradient(ellipse, rgba(102,16,242,0.12) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }

        .login-wrapper {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
        }

        .login-logo {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 24px rgba(13,110,253,0.35);
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            text-align: center;
            margin-bottom: 0.3rem;
        }

        .login-subtitle {
            font-size: 0.85rem;
            color: #6c8aaa;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-label {
            font-size: 0.83rem;
            font-weight: 500;
            color: #c9d6e3;
            margin-bottom: 0.4rem;
        }

        .form-control {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 10px;
            color: #ffffff;
            font-size: 0.875rem;
            padding: 0.65rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.09);
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13,110,253,0.2);
            color: #ffffff;
        }

        .form-control::placeholder { color: #4a6a8a; }

        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220,53,69,0.15);
        }

        .invalid-feedback { color: #ff6b7a; font-size: 0.78rem; }

        .input-icon-wrapper { position: relative; }
        .input-icon-wrapper .input-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: #4a6a8a;
            font-size: 0.95rem;
            pointer-events: none;
        }
        .input-icon-wrapper .form-control { padding-left: 2.5rem; }

        .btn-login {
            background: linear-gradient(135deg, #0d6efd, #0856c7);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 0.75rem;
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(13,110,253,0.35);
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(13,110,253,0.45);
            background: linear-gradient(135deg, #2681ff, #0d6efd);
        }

        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #4a6a8a;
        }
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-logo">
            <i class="bi bi-person-plus-fill"></i>
        </div>
        <h1 class="login-title">Registro</h1>
        <p class="login-subtitle">Crea una cuenta en el Sistema Médico</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre Completo</label>
                <div class="input-icon-wrapper">
                    <i class="bi bi-person-fill input-icon"></i>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Ej: Juan Pérez" required autofocus autocomplete="name">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <div class="input-icon-wrapper">
                    <i class="bi bi-envelope-fill input-icon"></i>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autocomplete="username">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-icon-wrapper">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="••••••••" required autocomplete="new-password">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <div class="input-icon-wrapper">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="••••••••" required autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-check2-circle me-2"></i>Registrarse
            </button>
        </form>

        <div class="login-footer">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold">Inicia Sesión</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
