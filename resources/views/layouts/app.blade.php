<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Gestión de Citas Médicas - Centro de Salud">
    <title>@yield('titulo', 'Centro de Salud') | SaludSystem</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f1c2e;
            --primary: #0d6efd;
            --body-bg: #f0f4f8;
        }

        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--body-bg); margin: 0; overflow-x: hidden; }

        #sidebar {
            position: fixed; top: 0; left: 0; height: 100vh; width: var(--sidebar-width);
            background: var(--sidebar-bg); z-index: 1000; transition: transform 0.3s ease;
            overflow-y: auto; scrollbar-width: thin; scrollbar-color: #2a3f5a var(--sidebar-bg);
        }
        #sidebar::-webkit-scrollbar { width: 4px; }
        #sidebar::-webkit-scrollbar-thumb { background: #2a3f5a; border-radius: 2px; }

        .sidebar-brand { padding: 1.5rem 1.25rem 1rem; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .brand-logo {
            width: 38px; height: 38px; background: linear-gradient(135deg, #0d6efd, #6610f2);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: white; flex-shrink: 0;
        }
        .brand-text h6 { font-size: 0.85rem; font-weight: 700; color: #fff; margin: 0; line-height: 1.2; }
        .brand-text small { font-size: 0.7rem; color: #6c8aaa; }

        .sidebar-section { padding: 1rem 0 0.5rem; }
        .sidebar-label { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em; color: #4a6a8a; padding: 0.25rem 1.25rem 0.5rem; text-transform: uppercase; }

        .sidebar-nav .nav-link {
            display: flex; align-items: center; gap: 0.7rem; padding: 0.55rem 1.25rem;
            color: #c9d6e3; font-size: 0.875rem; font-weight: 400; transition: all 0.2s ease;
            text-decoration: none; border-left: 3px solid transparent;
        }
        .sidebar-nav .nav-link i { font-size: 1rem; width: 20px; text-align: center; opacity: 0.7; }
        .sidebar-nav .nav-link:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .sidebar-nav .nav-link:hover i { opacity: 1; }
        .sidebar-nav .nav-link.active {
            background: linear-gradient(90deg, rgba(13,110,253,0.25) 0%, rgba(13,110,253,0.05) 100%);
            color: #fff; font-weight: 500; border-left-color: var(--primary);
        }
        .sidebar-nav .nav-link.active i { opacity: 1; color: #6ea8fe; }

        #main-content { margin-left: var(--sidebar-width); min-height: 100vh; display: flex; flex-direction: column; transition: margin-left 0.3s ease; }

        #topbar {
            height: 60px; background: #fff; border-bottom: 1px solid #e5eaf0;
            display: flex; align-items: center; padding: 0 1.5rem;
            position: sticky; top: 0; z-index: 900; box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }
        #topbar .topbar-title { font-size: 1rem; font-weight: 600; color: #1a2c42; }

        .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 0.85rem; font-weight: 600;
        }

        .page-content { padding: 1.5rem; flex: 1; }
        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .page-header h1 { font-size: 1.375rem; font-weight: 700; color: #1a2c42; margin: 0; }

        .stat-card {
            background: #fff; border-radius: 14px; padding: 1.25rem; border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; }

        .table-card { background: #fff; border-radius: 14px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
        .table-card .table-header { padding: 1rem 1.25rem; border-bottom: 1px solid #f0f4f8; display: flex; align-items: center; justify-content: space-between; }
        .table-card .table { margin: 0; }
        .table-card .table th { background: #f8fafc; font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; border-bottom: 1px solid #e2e8f0; padding: 0.75rem 1rem; }
        .table-card .table td { padding: 0.75rem 1rem; vertical-align: middle; font-size: 0.875rem; border-bottom: 1px solid #f1f5f9; }
        .table-card .table tbody tr:hover { background: #f8fafc; }
        .table-card .table tbody tr:last-child td { border-bottom: none; }

        .btn-icon { width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 0.875rem; }

        .form-card { background: #fff; border-radius: 14px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 1.75rem; }
        .form-label { font-size: 0.875rem; font-weight: 500; color: #374151; }
        .form-control, .form-select { border-radius: 8px; border-color: #e2e8f0; font-size: 0.875rem; padding: 0.55rem 0.875rem; }
        .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13,110,253,0.12); }

        .btn-primary { background: linear-gradient(135deg, #0d6efd, #0856c7); border: none; border-radius: 8px; font-weight: 500; font-size: 0.875rem; padding: 0.55rem 1.25rem; }
        .btn-outline-secondary { border-radius: 8px; font-size: 0.875rem; }

        .alert { border-radius: 10px; border: none; font-size: 0.875rem; }

        @media (max-width: 991px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main-content { margin-left: 0; }
        }
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; }
        .sidebar-overlay.show { display: block; }
    </style>
    @stack('styles')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<nav id="sidebar">
    <div class="sidebar-brand d-flex align-items-center gap-2">
        <div class="brand-logo"><i class="bi bi-heart-pulse-fill"></i></div>
        <div class="brand-text">
            <h6>SaludSystem</h6>
            <small>Centro de Salud</small>
        </div>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Principal</div>
        <ul class="sidebar-nav list-unstyled mb-0">
            <li>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
            </li>
        </ul>
    </div>

    @if(auth()->user()->esAdmin())
    <div class="sidebar-section">
        <div class="sidebar-label">Administración</div>
        <ul class="sidebar-nav list-unstyled mb-0">
            <li><a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}"><i class="bi bi-people-fill"></i> Usuarios</a></li>
            <li><a href="{{ route('especialidades.index') }}" class="nav-link {{ request()->routeIs('especialidades.*') ? 'active' : '' }}"><i class="bi bi-mortarboard-fill"></i> Especialidades</a></li>
            <li><a href="{{ route('doctores.index') }}" class="nav-link {{ request()->routeIs('doctores.*') ? 'active' : '' }}"><i class="bi bi-person-badge-fill"></i> Doctores</a></li>
        </ul>
    </div>
    @endif

    @if(auth()->user()->esAdmin() || auth()->user()->esRecepcionista())
    <div class="sidebar-section">
        <div class="sidebar-label">Pacientes</div>
        <ul class="sidebar-nav list-unstyled mb-0">
            <li><a href="{{ route('pacientes.index') }}" class="nav-link {{ request()->routeIs('pacientes.*') ? 'active' : '' }}"><i class="bi bi-person-heart"></i> Pacientes</a></li>
        </ul>
    </div>
    @endif

    <div class="sidebar-section">
        <div class="sidebar-label">Agenda</div>
        <ul class="sidebar-nav list-unstyled mb-0">
            <li><a href="{{ route('citas.index') }}" class="nav-link {{ request()->routeIs('citas.*') ? 'active' : '' }}"><i class="bi bi-calendar2-check-fill"></i> Citas</a></li>
            @if(auth()->user()->esAdmin() || auth()->user()->esDoctor())
            <li><a href="{{ route('consultas.index') }}" class="nav-link {{ request()->routeIs('consultas.*') ? 'active' : '' }}"><i class="bi bi-file-medical-fill"></i> Consultas</a></li>
            @endif
        </ul>
    </div>

    <div style="border-top: 1px solid rgba(255,255,255,0.08); padding: 1rem 1.25rem; margin-top: auto;">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div class="user-avatar" style="width:32px;height:32px;font-size:0.75rem;">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div>
                <div style="font-size:0.78rem;font-weight:600;color:#c9d6e3;">{{ auth()->user()->name }}</div>
                <div style="font-size:0.68rem;color:#4a6a8a;">{{ auth()->user()->rol->nombre ?? '' }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm w-100 text-start" style="background:rgba(220,53,69,0.12);color:#ff6b7a;border:none;border-radius:8px;padding:0.4rem 0.75rem;font-size:0.8rem;">
                <i class="bi bi-box-arrow-left me-1"></i> Cerrar Sesión
            </button>
        </form>
    </div>
</nav>

<div id="main-content">
    <div id="topbar">
        <button class="btn btn-sm btn-light me-3 d-lg-none" onclick="toggleSidebar()"><i class="bi bi-list fs-5"></i></button>
        <span class="topbar-title">@yield('titulo', 'Dashboard')</span>
        <div class="ms-auto d-flex align-items-center gap-2">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
        </div>
    </div>

    <div class="page-content">
        @if(session('exito'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-check-circle-fill"></i> {{ session('exito') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-3">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Por favor corrige los errores:</strong>
                <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('contenido')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.alert-dismissible').forEach(function(el) {
            setTimeout(function() {
                var a = bootstrap.Alert.getOrCreateInstance(el);
                if (a) a.close();
            }, 5000);
        });
    });
</script>
@stack('scripts')
</body>
</html>
