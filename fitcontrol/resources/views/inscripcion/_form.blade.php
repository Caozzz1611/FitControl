@extends('layouts.app')

@section('title', 'Crear Inscripción')

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

    .form-group .error-message {
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
    background: #0056b3;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s ease;
}
</style>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">{{ isset($inscripcion) ? 'Editar Inscripción' : 'Nueva Inscripción' }}</h1>

    <form id="formInscripcion" action="{{ isset($inscripcion) ? route('inscripcion.update', $inscripcion) : route('inscripcion.store') }}" method="POST" novalidate>
        @csrf
        @if(isset($inscripcion))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="id_usu_fk">Usuario</label>
            <select id="id_usu_fk" name="id_usu_fk">
                <option value="">-- Selecciona un usuario --</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usu }}"
                        {{ old('id_usu_fk', optional($inscripcion)->id_usu_fk) == $usuario->id_usu ? 'selected' : '' }}>
                        {{ $usuario->nombre }} {{ $usuario->apellido }}
                    </option>
                @endforeach
            </select>
            <span class="error-message"></span>
        </div>

        <div class="form-group">
            <label for="id_torneo_fk">Torneo</label>
            <select id="id_torneo_fk" name="id_torneo_fk">
                <option value="">-- Selecciona un torneo --</option>
                @foreach($torneos as $torneo)
                    <option value="{{ $torneo->id_torneo }}"
                        {{ old('id_torneo_fk', optional($inscripcion)->id_torneo_fk) == $torneo->id_torneo ? 'selected' : '' }}>
                        {{ $torneo->nombre }}
                    </option>
                @endforeach
            </select>
            <span class="error-message"></span>
        </div>

        <div class="form-group">
            <label for="fecha_inscripcion">Fecha Inscripción</label>
            <input type="date" id="fecha_inscripcion" name="fecha_inscripcion" value="{{ old('fecha_inscripcion', optional($inscripcion)->fecha_inscripcion) }}">
            <span class="error-message"></span>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select id="estado" name="estado">
                <option value="">-- Selecciona estado --</option>
                <option value="Pendiente" {{ old('estado', optional($inscripcion)->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="Completado" {{ old('estado', optional($inscripcion)->estado) == 'Completado' ? 'selected' : '' }}>Completado</option>
            </select>
            <span class="error-message"></span>
        </div>

        <button type="submit">Guardar</button>
        <a href="{{ url()->previous() }}" class="btn-back mt-4 inline-block text-blue-500 hover:underline">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </form>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formInscripcion');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let valid = true;

        form.querySelectorAll('.error-message').forEach(msg => {
            msg.textContent = '';
            msg.style.display = 'none';
        });

        form.querySelectorAll('input, select').forEach(input => input.style.borderColor = '#ccc');

        const usuario = form.id_usu_fk.value;
        const torneo = form.id_torneo_fk.value;
        const fecha = form.fecha_inscripcion.value;
        const estado = form.estado.value;
        const hoy = new Date();
        hoy.setHours(0,0,0,0);

        if (!usuario) {
            const msg = form.querySelector('#id_usu_fk + .error-message');
            msg.textContent = 'Seleccione un usuario.';
            msg.style.display = 'block';
            form.id_usu_fk.style.borderColor = 'red';
            valid = false;
        }

        if (!torneo) {
            const msg = form.querySelector('#id_torneo_fk + .error-message');
            msg.textContent = 'Seleccione un torneo.';
            msg.style.display = 'block';
            form.id_torneo_fk.style.borderColor = 'red';
            valid = false;
        }

        if (!fecha) {
            const msg = form.querySelector('#fecha_inscripcion + .error-message');
            msg.textContent = 'Seleccione una fecha.';
            msg.style.display = 'block';
            form.fecha_inscripcion.style.borderColor = 'red';
            valid = false;
        } else if (new Date(fecha) < hoy) {
            const msg = form.querySelector('#fecha_inscripcion + .error-message');
            msg.textContent = 'La fecha no puede ser anterior a hoy.';
            msg.style.display = 'block';
            form.fecha_inscripcion.style.borderColor = 'red';
            valid = false;
        }

        if (!estado) {
            const msg = form.querySelector('#estado + .error-message');
            msg.textContent = 'Seleccione un estado.';
            msg.style.display = 'block';
            form.estado.style.borderColor = 'red';
            valid = false;
        }

        if (valid) form.submit();
    });
});
</script>
@endpush
