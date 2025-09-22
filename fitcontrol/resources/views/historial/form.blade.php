@extends('layouts.app')

@section('title', 'Crear Historial Médico')

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
    <h1 class="text-2xl font-bold mb-4">{{ isset($historial) ? 'Editar Historial Médico' : 'Nuevo Historial Médico' }}</h1>

    <form id="formHistorial" action="{{ isset($historial) ? route('historial.update', $historial) : route('historial.store') }}" method="POST" novalidate>
        @csrf
        @if(isset($historial))
            @method('PUT')
        @endif

        <div class="form-group">
            <label>Observaciones</label>
            <textarea name="observaciones" rows="3">{{ old('observaciones', optional($historial)->observaciones) }}</textarea>
            <span class="error-message"></span>
        </div>

        <div class="form-group">
            <label>Fecha</label>
            <input type="date" name="fecha" value="{{ old('fecha', optional($historial)->fecha) }}">
            <span class="error-message"></span>
        </div>

        <div class="form-group">
            <label>Usuario</label>
            <select name="id_usu_fk">
                <option value="">-- Selecciona un usuario --</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usu }}"
                        {{ old('id_usu_fk', optional($historial)->id_usu_fk) == $usuario->id_usu ? 'selected' : '' }}>
                        {{ $usuario->nombre }} {{ $usuario->apellido }}
                    </option>
                @endforeach
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
    const form = document.getElementById('formHistorial');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let valid = true;

        form.querySelectorAll('.error-message').forEach(msg => {
            msg.textContent = '';
            msg.style.display = 'none';
        });

        const observaciones = form.observaciones.value.trim();
        const fecha = form.fecha.value;
        const usuario = form.id_usu_fk.value;
        const hoy = new Date();
        hoy.setHours(0,0,0,0);
        const fechaSeleccionada = new Date(fecha);

        if (!observaciones) {
            const msg = form.querySelector('textarea[name="observaciones"] + .error-message');
            msg.textContent = 'El campo observaciones es obligatorio.';
            msg.style.display = 'block';
            valid = false;
        }

        if (!fecha) {
            const msg = form.querySelector('input[name="fecha"] + .error-message');
            msg.textContent = 'Seleccione una fecha.';
            msg.style.display = 'block';
            valid = false;
        } else if (fechaSeleccionada < hoy) {
            const msg = form.querySelector('input[name="fecha"] + .error-message');
            msg.textContent = 'La fecha no puede ser anterior a hoy.';
            msg.style.display = 'block';
            valid = false;
        }

        if (!usuario) {
            const msg = form.querySelector('select[name="id_usu_fk"] + .error-message');
            msg.textContent = 'Seleccione un usuario.';
            msg.style.display = 'block';
            valid = false;
        }

        if (valid) form.submit();
    });
});
</script>
@endpush
