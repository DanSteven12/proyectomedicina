@extends('layouts.app')
@section('titulo', 'Nuevo Paciente')

@push('styles')
<style>
    #cp-spinner { display: none; }
    #cp-mensaje { font-size: 0.78rem; min-height: 1.2rem; margin-top: 0.3rem; }
</style>
@endpush

@section('contenido')
<div class="page-header">
    <h1><i class="bi bi-person-plus-fill me-2" style="color:#0d6efd;"></i>Nuevo Paciente</h1>
    <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Regresar</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="form-card">
            <form method="POST" action="{{ route('pacientes.store') }}">
                @csrf

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-person-fill me-2 text-primary"></i>Datos Personales
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre(s) <span class="text-danger">*</span></label>
                        <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control @error('apellido_paterno') is-invalid @enderror" value="{{ old('apellido_paterno') }}" required>
                        @error('apellido_paterno')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                        <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="{{ old('apellido_materno') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="sexo" class="form-label">Sexo <span class="text-danger">*</span></label>
                        <select id="sexo" name="sexo" class="form-select @error('sexo') is-invalid @enderror" required>
                            <option value="">Seleccionar...</option>
                            <option value="Masculino" {{ old('sexo') === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('sexo') === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        @error('sexo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}">
                        @error('fecha_nacimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="curp" class="form-label">CURP</label>
                        <input type="text" id="curp" name="curp" class="form-control @error('curp') is-invalid @enderror" value="{{ old('curp') }}" maxlength="18" style="text-transform:uppercase;" placeholder="18 caracteres">
                        @error('curp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-telephone-fill me-2 text-primary"></i>Contacto
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono') }}" maxlength="15" placeholder="10 dígitos">
                    </div>
                    <div class="col-md-8">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" id="correo" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" placeholder="paciente@ejemplo.com">
                        @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h6 class="fw-semibold mb-3" style="color:#1a2c42;border-bottom:1px solid #f0f4f8;padding-bottom:0.75rem;">
                    <i class="bi bi-geo-alt-fill me-2 text-primary"></i>Domicilio
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion') }}" placeholder="Calle, número, colonia">
                    </div>
                    <div class="col-md-3">
                        <label for="codigo_postal" class="form-label">
                            Código Postal
                            <span id="cp-spinner" class="spinner-border spinner-border-sm ms-1 text-primary" role="status"></span>
                        </label>
                        <input type="text" id="codigo_postal" name="codigo_postal" class="form-control @error('codigo_postal') is-invalid @enderror"
                            value="{{ old('codigo_postal') }}" maxlength="5" placeholder="5 dígitos" autocomplete="off">
                        <div id="cp-mensaje" class="text-muted"></div>
                        @error('codigo_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-5">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado') }}" placeholder="Se autocompleta con el CP">
                        @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="municipio" class="form-label">Municipio</label>
                        <input type="text" id="municipio" name="municipio" class="form-control" value="{{ old('municipio') }}" placeholder="Se autocompleta con el CP">
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Guardar</button>
                    <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('curp').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});

document.getElementById('codigo_postal').addEventListener('input', function() {
    const cp = this.value.trim();
    const msgEl = document.getElementById('cp-mensaje');
    const spinner = document.getElementById('cp-spinner');

    if (cp.length !== 5 || !/^\d{5}$/.test(cp)) {
        msgEl.textContent = '';
        msgEl.className = 'text-muted';
        return;
    }

    spinner.style.display = 'inline-block';
    msgEl.textContent = 'Buscando...';
    msgEl.className = 'text-muted';

    fetch(`https://api.zippopotam.us/mx/${cp}`)
        .then(response => {
            if (!response.ok) throw new Error('CP no encontrado');
            return response.json();
        })
        .then(data => {
            const place = data.places[0];
            document.getElementById('estado').value = data['country abbreviation'] === 'MX' ? place['state'] : '';
            document.getElementById('municipio').value = place['place name'] || '';
            msgEl.textContent = '✓ Datos autocompletados';
            msgEl.className = 'text-success';
        })
        .catch(() => {
            document.getElementById('estado').value = '';
            document.getElementById('municipio').value = '';
            msgEl.textContent = 'Código postal no encontrado. Ingresa manualmente.';
            msgEl.className = 'text-warning';
        })
        .finally(() => {
            spinner.style.display = 'none';
        });
});
</script>
@endpush
