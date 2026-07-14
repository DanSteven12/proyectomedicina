@extends('layouts.app')
@section('titulo', 'Usuarios')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-people-fill me-2" style="color:#0d6efd;"></i>Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Nuevo Usuario</a>
</div>

<div class="table-card">
    <div class="table-header">
        <form class="d-flex gap-2" method="GET" action="{{ route('usuarios.index') }}">
            <input type="text" name="buscar" class="form-control" style="max-width:260px;font-size:0.85rem;" placeholder="Buscar por nombre o correo..." value="{{ request('buscar') }}">
            <button class="btn btn-outline-secondary btn-sm px-3" type="submit"><i class="bi bi-search"></i></button>
            @if(request('buscar'))<a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm px-3"><i class="bi bi-x-lg"></i></a>@endif
        </form>
        <small class="text-muted">{{ $usuarios->total() }} registros</small>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr><th>Usuario</th><th>Correo</th><th>Rol</th><th>Creado</th><th class="text-center">Acciones</th></tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:34px;height:34px;border-radius:8px;background:linear-gradient(135deg,#0d6efd,#6610f2);display:flex;align-items:center;justify-content:center;color:white;font-size:0.75rem;font-weight:700;flex-shrink:0;">
                                {{ strtoupper(substr($usuario->name, 0, 2)) }}
                            </div>
                            <span class="fw-semibold" style="font-size:0.875rem;">{{ $usuario->name }}</span>
                        </div>
                    </td>
                    <td style="font-size:0.85rem;color:#64748b;">{{ $usuario->email }}</td>
                    <td>
                        @php $colores = [1=>'danger',2=>'success',3=>'info']; $c = $colores[$usuario->role_id] ?? 'secondary'; @endphp
                        <span class="badge bg-{{ $c }}-subtle text-{{ $c }} border border-{{ $c }}-subtle" style="font-size:0.72rem;border-radius:6px;">
                            {{ $usuario->rol->nombre ?? '—' }}
                        </span>
                    </td>
                    <td style="font-size:0.83rem;color:#64748b;">{{ $usuario->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-outline-warning btn-icon" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                            @if($usuario->id !== auth()->id())
                            <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" class="d-inline" onsubmit="return confirm('¿Eliminar el usuario {{ $usuario->name }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger btn-icon" title="Eliminar"><i class="bi bi-trash-fill"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4"><i class="bi bi-person-x fs-3 d-block mb-2 opacity-25"></i>No se encontraron usuarios</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($usuarios->hasPages())<div class="px-3 py-2 border-top">{{ $usuarios->links() }}</div>@endif
</div>
@endsection
