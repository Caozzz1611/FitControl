@extends('layouts.app')

@section('title', 'Crear Torneo')

@section('content')
<style>
/* Tu CSS existente */
form {
    max-width: 1000px;
    margin: 30px auto;
    padding: 25px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0px 4px 15px rgba(0,0,0,0.08);
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: bold;
    margin-bottom: 8px;
    font-size: 14px;
    color: #444;
}

.form-group input,
.form-group textarea,
.form-group select {
    padding: 12px 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
    width: 100%;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0px 0px 6px rgba(0,123,255,0.2);
}

.hint {
    font-size: 12px;
    color: #666;
    margin-top: 4px;
}

.error-message {
    color: red;
    font-size: 13px;
    margin-top: 4px;
    display: none;
}

button {
    grid-column: span 3;
    background: #007bff;
    color: #fff;
    padding: 14px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background 0.3s ease;
}

button:hover {
    background: #0056b3;
}

.btn-back {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    background: #6c757d;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s ease;
}

.btn-back:hover {
    background: #565e64;
}
</style>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">{{ isset($torneo) ? 'Editar Torneo' : 'Crear Torneo' }}</h1>

    {{-- AQUI ESTÁ LA UNICA CORRECCIÓN --}}
    <form id="formTorneo" 
          action="{{ isset($torneo) && $torneo->id_torneo ? route('torneo.update', $torneo->id_torneo) : route('torneo.store') }}" 
          method="POST" novalidate>
        @csrf
        @if(isset($torneo) && $torneo->id_torneo)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', optional($torneo)->nombre) }}">
            <span class="hint">Ingrese el nombre oficial del torneo.</span>
            <span class="error-message"></span>
        </div>

        <div class="form-group">
            <label for="premio">Premio</label>
            <input type="number" id="premio" name="premio" value="{{ old('premio', optional($torneo)->premio) }}">
            <span class="hint">Monto en números, sin puntos ni comas.</span>
            <span class="error-message"></span>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion">{{ old('descripcion', optional($torneo)->descripcion) }}</textarea>
            <span class="hint">Agregue una breve descripción del torneo.</span>
            <span class="error-message"></span>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha Inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', optional($torneo)->fecha_inicio) }}">
            <span class="hint">Seleccione la fecha en que comienza el torneo.</span>
            <span class="error-message"></span>
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha Fin</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', optional($torneo)->fecha_fin) }}">
            <span class="hint">Seleccione la fecha en que finaliza el torneo.</span>
            <span class="error-message"></span>
        </div>

        <div class="form-group">
            <label for="id_equipo_fk">Organizador</label>
            <select id="id_equipo_fk" name="id_equipo_fk">
                <option value="">-- Selecciona un Organizador --</option>
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id_equipo }}" {{ old('id_equipo_fk', optional($torneo)->id_equipo_fk) == $equipo->id_equipo ? 'selected' : '' }}>
                        {{ $equipo->nombre_equipo }}
                    </option>
                @endforeach
            </select>
            <span class="hint">Seleccione el equipo encargado de la organización.</span>
            <span class="error-message"></span>
        </div>

        <button type="submit">Guardar</button>
        <a href="{{ url()->previous() }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </form>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formTorneo');
    const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let valid = true;

        // Limpiar mensajes de error y bordes previos
        form.querySelectorAll('.error-message').forEach(msg => {
            msg.textContent = '';
            msg.style.display = 'none';
        });
        form.querySelectorAll('input, select, textarea').forEach(input => input.style.borderColor = '#ccc');

        // Validación y mensajes de error
        const nombre = form.nombre.value.trim();
        const premio = form.premio.value.trim();
        const descripcion = form.descripcion.value.trim();
        const fecha_inicio = form.fecha_inicio.value.trim();
        const fecha_fin = form.fecha_fin.value.trim();
        const id_equipo_fk = form.id_equipo_fk.value;

        if (!nombre) {
            valid = false;
            const msg = form.querySelector('#nombre + .hint + .error-message');
            msg.textContent = 'El nombre del torneo es obligatorio.';
            msg.style.display = 'block';
            form.nombre.style.borderColor = 'red';
        }

        if (!premio) {
            valid = false;
            const msg = form.querySelector('#premio + .hint + .error-message');
            msg.textContent = 'El premio es obligatorio.';
            msg.style.display = 'block';
            form.premio.style.borderColor = 'red';
        } else if (isNaN(premio) || premio < 0) {
            valid = false;
            const msg = form.querySelector('#premio + .hint + .error-message');
            msg.textContent = 'El premio debe ser un número positivo.';
            msg.style.display = 'block';
            form.premio.style.borderColor = 'red';
        }

        if (!descripcion) {
            valid = false;
            const msg = form.querySelector('#descripcion + .hint + .error-message');
            msg.textContent = 'La descripción es obligatoria.';
            msg.style.display = 'block';
            form.descripcion.style.borderColor = 'red';
        }

        if (!fecha_inicio) {
            valid = false;
            const msg = form.querySelector('#fecha_inicio + .hint + .error-message');
            msg.textContent = 'La fecha de inicio es obligatoria.';
            msg.style.display = 'block';
            form.fecha_inicio.style.borderColor = 'red';
        }

        if (!fecha_fin) {
            valid = false;
            const msg = form.querySelector('#fecha_fin + .hint + .error-message');
            msg.textContent = 'La fecha de fin es obligatoria.';
            msg.style.display = 'block';
            form.fecha_fin.style.borderColor = 'red';
        } else if (new Date(fecha_fin) < new Date(fecha_inicio)) {
            valid = false;
            const msg = form.querySelector('#fecha_fin + .hint + .error-message');
            msg.textContent = 'La fecha de fin no puede ser anterior a la de inicio.';
            msg.style.display = 'block';
            form.fecha_fin.style.borderColor = 'red';
        }

        if (!id_equipo_fk) {
            valid = false;
            const msg = form.querySelector('#id_equipo_fk + .hint + .error-message');
            msg.textContent = 'El organizador es obligatorio.';
            msg.style.display = 'block';
            form.id_equipo_fk.style.borderColor = 'red';
        }

        if (valid) {
            form.submit();
        } else {
            notyf.error('Por favor, corrija los errores del formulario.');
        }
    });

    // Mostrar Notyf de éxito o error si viene de Laravel
    @if(session('success'))
        notyf.success("{{ session('success') }}");
    @endif
    @if(session('error'))
        notyf.error("{{ session('error') }}");
    @endif
});
</script>
@endpush
@endsection