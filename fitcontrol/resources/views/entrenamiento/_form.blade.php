@extends('layouts.app')

@section('title', 'Crear Entrenamiento')

@section('content')
<style>
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
        margin-bottom: 10px;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 4px;
        font-size: 14px;
        color: #444;
    }

    .hint {
        font-size: 12px;
        color: #666;
        margin-top: 4px;
    }

    .form-group input,
    .form-group select {
        padding: 12px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0px 0px 6px rgba(0,123,255,0.2);
    }

    .form-group img {
        margin-top: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        max-width: 120px;
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
    background: #0056b3;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s ease;
}

    /* Estilo para los mensajes de error */
    .form-group .error-message {
        color: red;
        font-size: 12px; /* Tamaño pequeño */
        margin-top: 4px;
        display: none;
    }
</style>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">{{ isset($entrenamiento) ? 'Editar Entrenamiento' : 'Nuevo Entrenamiento' }}</h1>

    <form id="formEntrenamiento" action="{{ isset($entrenamiento) ? route('entrenamiento.update', $entrenamiento) : route('entrenamiento.store') }}" method="POST" novalidate>
        @csrf
        @if(isset($entrenamiento))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="{{ old('fecha', optional($entrenamiento)->fecha) }}" required>
            <span class="error-message">La fecha es obligatoria.</span>
            <span class="hint">Selecciona la fecha del entrenamiento.</span>
        </div>

        <div class="form-group">
            <label for="hora">Hora</label>
            <input type="time" id="hora" name="hora" value="{{ old('hora', optional($entrenamiento)->hora) }}" required>
            <span class="error-message">La hora es obligatoria.</span>
            <span class="hint">Ingresa la hora de inicio del entrenamiento.</span>
        </div>

        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <input type="text" id="ubicacion" name="ubicacion" value="{{ old('ubicacion', optional($entrenamiento)->ubicacion) }}" required>
            <span class="error-message">La ubicación es obligatoria.</span>
            <span class="hint">Escribe la dirección o lugar donde se realizará el entrenamiento.</span>
        </div>

        <div class="form-group">
            <label for="id_equipo_fk">Equipo</label>
            <select id="id_equipo_fk" name="id_equipo_fk" required>
                <option value="">-- Selecciona un equipo --</option>
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id_equipo }}"
                        {{ old('id_equipo_fk', optional($entrenamiento)->id_equipo_fk) == $equipo->id_equipo ? 'selected' : '' }}>
                        {{ $equipo->nombre_equipo }}
                    </option>
                @endforeach
            </select>
            <span class="error-message">Selecciona un equipo.</span>
            <span class="hint">Selecciona el equipo que participará en este entrenamiento.</span>
        </div>

        <button type="submit">Guardar</button>

        <a href="{{ url()->previous() }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </form>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formEntrenamiento');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let valid = true;

        form.querySelectorAll('.error-message').forEach(msg => {
            msg.textContent = '';
            msg.style.display = 'none';
        });

        const fecha = form.fecha.value;
        const hora = form.hora.value;
        const ubicacion = form.ubicacion.value.trim();
        const equipo = form.id_equipo_fk.value;
        const hoy = new Date();
        hoy.setHours(0,0,0,0);
        const fechaSeleccionada = new Date(fecha);

        // Validación de la fecha
        if (!fecha) {
            const msg = form.querySelector('input[name="fecha"] + .error-message');
            msg.textContent = 'La fecha es obligatoria.';
            msg.style.display = 'block';
            valid = false;
        } else if (fechaSeleccionada < hoy) {
            const msg = form.querySelector('input[name="fecha"] + .error-message');
            msg.textContent = 'La fecha no puede ser anterior a hoy.';
            msg.style.display = 'block';
            valid = false;
        }

        // Validación de la hora
        if (!hora) {
            const msg = form.querySelector('input[name="hora"] + .error-message');
            msg.textContent = 'La hora es obligatoria.';
            msg.style.display = 'block';
            valid = false;
        }

        // Validación de la ubicación
        if (!ubicacion) {
            const msg = form.querySelector('input[name="ubicacion"] + .error-message');
            msg.textContent = 'La ubicación es obligatoria.';
            msg.style.display = 'block';
            valid = false;
        }

        // Validación del equipo
        if (!equipo) {
            const msg = form.querySelector('select[name="id_equipo_fk"] + .error-message');
            msg.textContent = 'Selecciona un equipo.';
            msg.style.display = 'block';
            valid = false;
        }

        if (valid) form.submit();
    });
});
</script>
@endpush
