@extends('layouts.app')

@section('title', isset($partido) ? 'Editar Partido' : 'Nuevo Partido')

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

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 12px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0px 0px 6px rgba(0,123,255,0.2);
    }

    .form-group .error-message {
        color: red;
        font-size: 13px;
        margin-top: 4px;
        display: none;
    }

    .form-group .hint {
        font-size: 12px;
        color: #666;
        margin-top: 4px;
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
        grid-column: span 3;
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-back a {
        color: #007bff;
    }
</style>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">{{ isset($partido) ? 'Editar Partido' : 'Nuevo Partido' }}</h1>

    <form id="formPartido" action="{{ isset($partido) ? route('partido.update', $partido) : route('partido.store') }}" method="POST" novalidate>
        @csrf
        @if(isset($partido))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $partido->fecha ?? '') }}">
            <span class="error-message"></span>
            <span class="hint">Seleccione la fecha del partido.</span>
        </div>

        <div class="form-group">
            <label for="hora">Hora</label>
            <input type="time" name="hora" id="hora" value="{{ old('hora', $partido->hora ?? '') }}">
            <span class="error-message"></span>
            <span class="hint">Seleccione la hora de inicio del partido.</span>
        </div>

        <div class="form-group">
            <label for="rival">Rival</label>
            <input type="text" name="rival" id="rival" value="{{ old('rival', $partido->rival ?? '') }}">
            <span class="error-message"></span>
            <span class="hint">Ingrese el nombre del equipo rival.</span>
        </div>

        <div class="form-group">
            <label for="resultado">Resultado</label>
            <input type="text" name="resultado" id="resultado" value="{{ old('resultado', $partido->resultado ?? '') }}">
            <span class="error-message"></span>
            <span class="hint">Ingrese el resultado final (opcional).</span>
        </div>

        <div class="form-group">
            <label for="id_torneo_fk">Torneo</label>
            <select name="id_torneo_fk" id="id_torneo_fk">
                <option value="">-- Selecciona un torneo --</option>
                @foreach($torneos as $torneo)
                    <option value="{{ $torneo->id_torneo }}" {{ old('id_torneo_fk', $partido->id_torneo_fk ?? '') == $torneo->id_torneo ? 'selected' : '' }}>
                        {{ $torneo->nombre }}
                    </option>
                @endforeach
            </select>
            <span class="error-message"></span>
            <span class="hint">Seleccione el torneo al que pertenece el partido.</span>
        </div>

        <div class="form-group">
            <label for="id_equipo_fk">Equipo</label>
            <select name="id_equipo_fk" id="id_equipo_fk">
                <option value="">-- Selecciona un equipo --</option>
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id_equipo }}" {{ old('id_equipo_fk', $partido->id_equipo_fk ?? '') == $equipo->id_equipo ? 'selected' : '' }}>
                        {{ $equipo->nombre_equipo }}
                    </option>
                @endforeach
            </select>
            <span class="error-message"></span>
            <span class="hint">Seleccione el equipo local que jugará el partido.</span>
        </div>

        <button type="submit">Guardar</button>
        <div class="btn-back">
            <a href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> Volver</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formPartido');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let valid = true;

        // Limpiar errores previos
        form.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
            el.style.display = 'none';
        });

        const fecha = form.fecha.value;
        const hora = form.hora.value;
        const rival = form.rival.value.trim();
        const torneo = form.id_torneo_fk.value;
        const equipo = form.id_equipo_fk.value;
        const hoy = new Date();
        hoy.setHours(0, 0, 0, 0);

        if (!fecha) {
            const msg = form.querySelector('#fecha + .error-message');
            msg.textContent = 'Seleccione una fecha.';
            msg.style.display = 'block';
            valid = false;
        } else if (new Date(fecha) < hoy) {
            const msg = form.querySelector('#fecha + .error-message');
            msg.textContent = 'La fecha no puede ser anterior a hoy.';
            msg.style.display = 'block';
            valid = false;
        }

        if (!hora) {
            const msg = form.querySelector('#hora + .error-message');
            msg.textContent = 'Seleccione una hora.';
            msg.style.display = 'block';
            valid = false;
        }

        if (!rival) {
            const msg = form.querySelector('#rival + .error-message');
            msg.textContent = 'Ingrese el nombre del equipo rival.';
            msg.style.display = 'block';
            valid = false;
        }

        if (!torneo) {
            const msg = form.querySelector('#id_torneo_fk + .error-message');
            msg.textContent = 'Seleccione un torneo.';
            msg.style.display = 'block';
            valid = false;
        }

        if (!equipo) {
            const msg = form.querySelector('#id_equipo_fk + .error-message');
            msg.textContent = 'Seleccione un equipo.';
            msg.style.display = 'block';
            valid = false;
        }

        if (valid) {
            form.submit();
        }
    });
});
</script>
@endpush
