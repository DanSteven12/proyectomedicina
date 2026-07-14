@extends('layouts.app')
@section('titulo', 'Dashboard')

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-grid-fill me-2" style="color:#0d6efd;"></i>Dashboard</h1>
    <small class="text-muted">{{ now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</small>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-xl-2-4">
        <div class="stat-card h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="text-muted" style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Pacientes</div>
                    <div class="fw-bold mt-1" style="font-size:1.75rem;color:#1a2c42;line-height:1;">{{ $totalPacientes }}</div>
                </div>
                <div class="stat-icon" style="background:rgba(13,110,253,0.1);color:#0d6efd;">
                    <i class="bi bi-person-heart"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size:0.75rem;color:#64748b;">Total registrados</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2-4">
        <div class="stat-card h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="text-muted" style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Doctores</div>
                    <div class="fw-bold mt-1" style="font-size:1.75rem;color:#1a2c42;line-height:1;">{{ $totalDoctores }}</div>
                </div>
                <div class="stat-icon" style="background:rgba(25,135,84,0.1);color:#198754;">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size:0.75rem;color:#64748b;">Personal médico</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2-4">
        <div class="stat-card h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="text-muted" style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Total Citas</div>
                    <div class="fw-bold mt-1" style="font-size:1.75rem;color:#1a2c42;line-height:1;">{{ $totalCitas }}</div>
                </div>
                <div class="stat-icon" style="background:rgba(102,16,242,0.1);color:#6610f2;">
                    <i class="bi bi-calendar2-check-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size:0.75rem;color:#64748b;">Historial completo</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2-4">
        <div class="stat-card h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="text-muted" style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Citas Hoy</div>
                    <div class="fw-bold mt-1" style="font-size:1.75rem;color:#1a2c42;line-height:1;">{{ $citasHoy }}</div>
                </div>
                <div class="stat-icon" style="background:rgba(255,193,7,0.15);color:#d97706;">
                    <i class="bi bi-calendar-day-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size:0.75rem;color:#64748b;">{{ now()->format('d/m/Y') }}</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2-4">
        <div class="stat-card h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="text-muted" style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Consultas</div>
                    <div class="fw-bold mt-1" style="font-size:1.75rem;color:#1a2c42;line-height:1;">{{ $totalConsultas }}</div>
                </div>
                <div class="stat-icon" style="background:rgba(13,202,240,0.12);color:#0891b2;">
                    <i class="bi bi-file-medical-fill"></i>
                </div>
            </div>
            <div class="mt-2" style="font-size:0.75rem;color:#64748b;">Realizadas</div>
        </div>
    </div>
</div>

<div class="table-card">
    <div class="table-header">
        <h6 class="mb-0 fw-semibold" style="color:#1a2c42;"><i class="bi bi-clock-history me-2 text-primary"></i>Citas Recientes</h6>
        <a href="{{ route('citas.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px;font-size:0.8rem;">
            <i class="bi bi-arrow-right me-1"></i>Ver todas
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citasRecientes as $cita)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:32px;height:32px;border-radius:8px;background:rgba(13,110,253,0.1);display:flex;align-items:center;justify-content:center;color:#0d6efd;font-size:0.75rem;font-weight:700;flex-shrink:0;">
                                {{ strtoupper(substr($cita->paciente->nombre ?? 'P', 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:500;font-size:0.85rem;">{{ $cita->paciente->nombre_completo ?? '—' }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:0.85rem;">{{ $cita->doctor->nombre_completo ?? '—' }}</td>
                    <td style="font-size:0.85rem;">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                    <td style="font-size:0.85rem;">{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>
                    <td>
                        @php
                            $estadoClases = [
                                'Pendiente'  => 'warning',
                                'Confirmada' => 'success',
                                'Cancelada'  => 'danger',
                                'Finalizada' => 'secondary',
                            ];
                            $clase = $estadoClases[$cita->estado] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $clase }}-subtle text-{{ $clase }} border border-{{ $clase }}-subtle" style="font-size:0.72rem;border-radius:6px;">
                            {{ $cita->estado }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('citas.show', $cita) }}" class="btn btn-sm btn-outline-primary btn-icon" title="Ver">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-calendar-x fs-3 d-block mb-2 opacity-25"></i>
                        No hay citas recientes
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
