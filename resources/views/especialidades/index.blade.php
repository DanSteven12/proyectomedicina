@extends('layouts.app')
@section('titulo', 'Especialidades')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-mortarboard-fill me-2" style="color:#0d6efd;"></i>Especialidades</h1>
    <a href="{{ route('especialidades.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Nueva Especialidad</a>
</div>

<div class="table-card">
    <div class="table-header">
        <form class="d-flex gap-2" method="GET" action="{{ route('especialidades.index') }}">
            <input type="text" name="buscar" class="form-control" style="max-width:240px;font-size:0.85rem;" placeholder="Buscar especialidad..." value="{{ request('buscar') }}">
            <button class="btn btn-outline-secondary btn-sm px-3" type="submit"><i class="bi bi-search"></i></button>
            @if(request('buscar'))<a href="{{ route('especialidades.index') }}" class="btn btn-outline-secondary btn-sm px-3"><i class="bi bi-x-lg"></i></a>@endif
        </form>
        <small class="text-muted">{{ $especialidades->total() }} registros</small>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Nombre</th><th>Descripción</th><th>Doctores</th><th class="text-center">Acciones</th></tr></thead>
            <tbody>
                @forelse($especialidades as $esp)
                <tr>
                    <td><span class="fw-semibold">{{ $esp->nombre }}</span></td>
                    <td style="font-size:0.83rem;color:#64748b;max-width:300px;">{{ Str::limit($esp->descripcion, 80, '...') ?? '—' }}</td>
                    <td><span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size:0.72rem;border-radius:6px;">{{ $esp->doctores->count() }}</span></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('especialidades.edit', $esp) }}" class="btn btn-sm btn-outline-warning btn-icon" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                            <form method="POST" action="{{ route('especialidades.destroy', $esp) }}" class="d-inline" onsubmit="return confirm('¿Eliminar la especialidad {{ $esp->nombre }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger btn-icon" title="Eliminar"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-4"><i class="bi bi-mortarboard fs-3 d-block mb-2 opacity-25"></i>No se encontraron especialidades</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($especialidades->hasPages())<div class="px-3 py-2 border-top">{{ $especialidades->links() }}</div>@endif
</div>
@endsection
