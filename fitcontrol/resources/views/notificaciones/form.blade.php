@extends('layouts.app')

@section('title', isset($notificacion) ? 'Editar Notificación' : 'Crear Notificación')

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
        grid-column: span 3;
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
        color: #ffffff;
        font-weight: bold;
    }
</style>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">{{ isset($notificacion) ? 'Editar Notificación' : 'Nueva Notificación' }}</h1>

    <form id="formNotificacion" action="{{ isset($notificacion) ? route('notificaciones.update', $notificacion->id_notificacion) : route('notificaciones.store') }}" method="POST" novalidate>
        @csrf
        @if(isset($notificacion))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $notificacion->titulo ?? '') }}">
            <span class="error-message"></span>
            <span class="hint">Ingrese un título descriptivo para la notificación.</span>
        </div>

        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje" rows="2">{{ old('mensaje', $notificacion->mensaje ?? '') }}</textarea>
            <span class="error-message"></span>
            <span class="hint">Escriba el mensaje que se enviará al usuario destinatario.</span>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="datetime-local" name="fecha" id="fecha" value="{{ old('fecha', isset($notificacion->fecha) ? date('Y-m-d\TH:i', strtotime($notificacion->fecha)) : '') }}">
            <span class="error-message"></span>
            <span class="hint">Seleccione la fecha y hora de la notificación.</span>
        </div>

        <div class="form-group">
            <label for="id_usuario_destinatario_fk">Usuario Destinatario</label>
            <select name="id_usuario_destinatario_fk" id="id_usuario_destinatario_fk">
                <option value="">-- Seleccione un usuario --</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usu }}" {{ old('id_usuario_destinatario_fk', $notificacion->id_usuario_destinatario_fk ?? '') == $usuario->id_usu ? 'selected' : '' }}>
                        {{ $usuario->nombre }} {{ $usuario->apellido }}
                    </option>
                @endforeach
            </select>
            <span class="error-message"></span>
            <span class="hint">Seleccione el usuario que recibirá la notificación.</span>
        </div>

        <button type="submit">Guardar</button>
        <a href="{{ route('notificaciones.index') }}" class="btn-back mt-4 inline-block text-blue-500 hover:underline">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </form>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formNotificacion');
    const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let valid = true;

        // Limpiar errores previos
        form.querySelectorAll('.error-message').forEach(msg => {
            msg.textContent = '';
            msg.style.display = 'none';
        });
        form.querySelectorAll('input, select, textarea').forEach(input => input.style.borderColor = '#ccc');

        const titulo = form.titulo.value.trim();
        const mensaje = form.mensaje.value.trim();
        const fecha = form.fecha.value;
        const usuario = form.id_usuario_destinatario_fk.value;
        const ahora = new Date();

        if (!titulo) {
            const msg = form.querySelector('#titulo + .error-message');
            msg.textContent = 'El título es obligatorio.';
            msg.style.display = 'block';
            form.titulo.style.borderColor = 'red';
            valid = false;
        }

        if (!mensaje) {
            const msg = form.querySelector('#mensaje + .error-message');
            msg.textContent = 'El mensaje es obligatorio.';
            msg.style.display = 'block';
            form.mensaje.style.borderColor = 'red';
            valid = false;
        }

        if (!fecha) {
            const msg = form.querySelector('#fecha + .error-message');
            msg.textContent = 'La fecha es obligatoria.';
            msg.style.display = 'block';
            form.fecha.style.borderColor = 'red';
            valid = false;
        } else if (new Date(fecha) < ahora) {
            const msg = form.querySelector('#fecha + .error-message');
            msg.textContent = 'La fecha no puede ser anterior a la actual.';
            msg.style.display = 'block';
            form.fecha.style.borderColor = 'red';
            valid = false;
        }

        if (!usuario) {
            const msg = form.querySelector('#id_usuario_destinatario_fk + .error-message');
            msg.textContent = 'Seleccione un usuario destinatario.';
            msg.style.display = 'block';
            form.id_usuario_destinatario_fk.style.borderColor = 'red';
            valid = false;
        }

        if (valid) {
            form.submit();
        } else {
            // Muestra una notificación global de Notyf si la validación falla
            notyf.error('Por favor, complete todos los campos obligatorios.');
        }
    });

    // Muestra notificaciones de éxito o error de Laravel
    @if(session('success'))
        notyf.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        notyf.error("{{ session('error') }}");
    @endif

    // Muestra errores de validación de Laravel, si existen
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            notyf.error("{{ $error }}");
        @endforeach
    @endif
});
</script>
@endpush
@endsection