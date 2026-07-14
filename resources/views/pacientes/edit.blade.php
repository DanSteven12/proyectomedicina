@extends('layouts.app')
@section('titulo', 'Editar Paciente')

@push('styles')
<style>#cp-spinner{display:none;}#cp-mensaje{font-size:0.78rem;min-height:1.2rem;margin-top:0.3rem;}</style>
@endpush

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-person-fill-gear me-2" style="color:#0d6efd;"></i>Editar Paciente</h1>
    <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="form-card">
            <form method="POST" action="{{ route('pacientes.update', $paciente) }}">
                @csrf @method('PUT')

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-person-fill me-2 text-primary"></i>Datos Personales
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre(s) <span class="text-danger">*</span></label>
                        <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $paciente->nombre) }}" required>
                        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control @error('apellido_paterno') is-invalid @enderror" value="{{ old('apellido_paterno', $paciente->apellido_paterno) }}" required>
                        @error('apellido_paterno')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                        <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="{{ old('apellido_materno', $paciente->apellido_materno) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="sexo" class="form-label">Sexo <span class="text-danger">*</span></label>
                        <select id="sexo" name="sexo" class="form-select @error('sexo') is-invalid @enderror" required>
                            <option value="Masculino" {{ old('sexo', $paciente->sexo) === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('sexo', $paciente->sexo) === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        @error('sexo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="curp" class="form-label">CURP</label>
                        <input type="text" id="curp" name="curp" class="form-control @error('curp') is-invalid @enderror" value="{{ old('curp', $paciente->curp) }}" maxlength="18" style="text-transform:uppercase;">
                        @error('curp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-telephone-fill me-2 text-primary"></i>Contacto
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono', $paciente->telefono) }}" maxlength="15">
                    </div>
                    <div class="col-md-8">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" id="correo" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo', $paciente->correo) }}">
                        @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-geo-alt-fill me-2 text-primary"></i>Domicilio
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion', $paciente->direccion) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="codigo_postal" class="form-label">
                            Código Postal
                            <span id="cp-spinner" class="spinner-border spinner-border-sm ms-1 text-primary" role="status"></span>
                        </label>
                        <input type="text" id="codigo_postal" name="codigo_postal" class="form-control @error('codigo_postal') is-invalid @enderror"
                            value="{{ old('codigo_postal', $paciente->codigo_postal) }}" maxlength="5" autocomplete="off">
                        <div id="cp-mensaje" class="text-muted"></div>
                        @error('codigo_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-5">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" id="estado" name="estado" class="form-control" value="{{ old('estado', $paciente->estado) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="municipio" class="form-label">Municipio</label>
                        <input type="text" id="municipio" name="municipio" class="form-control" value="{{ old('municipio', $paciente->municipio) }}">
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Actualizar</button>
                    <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('curp').addEventListener('input', function() { this.value = this.value.toUpperCase(); });

document.getElementById('codigo_postal').addEventListener('input', function() {
    const cp = this.value.trim();
    const msgEl = document.getElementById('cp-mensaje');
    const spinner = document.getElementById('cp-spinner');
    if (cp.length !== 5 || !/^\d{5}$/.test(cp)) { msgEl.textContent = ''; return; }
    spinner.style.display = 'inline-block';
    msgEl.textContent = 'Buscando...';
    fetch(`https://api.zippopotam.us/mx/${cp}`)
        .then(r => { if (!r.ok) throw new Error(); return r.json(); })
        .then(data => {
            const place = data.places[0];
            document.getElementById('estado').value = place['state'] || '';
            document.getElementById('municipio').value = place['place name'] || '';
            msgEl.textContent = '✓ Datos actualizados'; msgEl.className = 'text-success';
        })
        .catch(() => { msgEl.textContent = 'CP no encontrado. Ingresa manualmente.'; msgEl.className = 'text-warning'; })
        .finally(() => { spinner.style.display = 'none'; });
});
</script>
@endpush
