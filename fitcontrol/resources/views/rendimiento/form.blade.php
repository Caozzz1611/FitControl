@extends('layouts.app')

@section('title', isset($rendimiento) ? 'Editar Rendimiento' : 'Crear Rendimiento')

@section('content')
<style>
    form {
        max-width: 1000px;
        margin: 30px auto;
        padding: 25px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
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
        box-shadow: 0 0 6px rgba(0,123,255,0.2);
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
    background: #0056b3;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s ease;
}
</style>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">{{ isset($rendimiento) ? 'Editar Rendimiento' : 'Nuevo Rendimiento' }}</h1>

    <form id="formRendimiento"
          action="{{ isset($rendimiento) ? route('rendimiento.update', $rendimiento->id_rendimiento) : route('rendimiento.store') }}"
          method="POST"
          novalidate>
        @csrf
        @if(isset($rendimiento))
            @method('PUT')
        @endif

        <!-- Evaluación -->
        <div class="form-group">
            <label for="evaluacion">Evaluación</label>
            <input type="text" id="evaluacion" name="evaluacion" maxlength="100" value="{{ old('evaluacion', optional($rendimiento)->evaluacion) }}">
            <span class="error-message"></span>
            <span class="hint">Ej: Bueno, Excelente, Regular.</span>
        </div>

        <!-- Comentarios -->
        <div class="form-group">
            <label for="comentarios">Comentarios</label>
            <textarea id="comentarios" name="comentarios" maxlength="80" rows="3">{{ old('comentarios', optional($rendimiento)->comentarios) }}</textarea>
            <span class="error-message"></span>
            <span class="hint">Comentario breve sobre el rendimiento.</span>
        </div>

        <!-- Usuario -->
        <div class="form-group">
            <label for="id_usu_fk">Usuario</label>
            <select id="id_usu_fk" name="id_usu_fk">
                <option value="">-- Selecciona un usuario --</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usu }}" {{ old('id_usu_fk', optional($rendimiento)->id_usu_fk) == $usuario->id_usu ? 'selected' : '' }}>
                        {{ $usuario->nombre }} {{ $usuario->apellido }}
                    </option>
                @endforeach
            </select>
            <span class="error-message"></span>
            <span class="hint">Seleccione al usuario evaluado.</span>
        </div>

        <!-- Entrenamiento -->
        <div class="form-group">
            <label for="id_entrenamiento_fk">Entrenamiento</label>
            <select id="id_entrenamiento_fk" name="id_entrenamiento_fk">
                <option value="">-- Selecciona un entrenamiento --</option>
                @foreach($entrenamientos as $entrenamiento)
                    <option value="{{ $entrenamiento->id_entrenamiento }}" {{ old('id_entrenamiento_fk', optional($rendimiento)->id_entrenamiento_fk) == $entrenamiento->id_entrenamiento ? 'selected' : '' }}>
                        {{ $entrenamiento->fecha }} - {{ $entrenamiento->ubicacion }}
                    </option>
                @endforeach
            </select>
            <span class="error-message"></span>
            <span class="hint">Seleccione el entrenamiento correspondiente.</span>
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
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formRendimiento');
    const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        let valid = true;

        // Reset all errors
        form.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
            el.style.display = 'none';
        });
        form.querySelectorAll('input, textarea, select').forEach(el => {
            el.style.borderColor = '#ccc';
        });

        const evaluacion = form.evaluacion.value.trim();
        const comentarios = form.comentarios.value.trim();
        const usuario = form.id_usu_fk.value.trim();
        const entrenamiento = form.id_entrenamiento_fk.value.trim();

        // Validar evaluación
        if (!evaluacion) {
            valid = false;
            const msg = form.querySelector('#evaluacion + .error-message');
            msg.textContent = 'La evaluación es obligatoria.';
            msg.style.display = 'block';
            form.evaluacion.style.borderColor = 'red';
        }

        // Validar comentarios
        if (!comentarios) {
            valid = false;
            const msg = form.querySelector('#comentarios + .error-message');
            msg.textContent = 'El comentario es obligatorio.';
            msg.style.display = 'block';
            form.comentarios.style.borderColor = 'red';
        }

        // Validar usuario
        if (!usuario) {
            valid = false;
            const msg = form.querySelector('#id_usu_fk + .error-message');
            msg.textContent = 'Debe seleccionar un usuario.';
            msg.style.display = 'block';
            form.id_usu_fk.style.borderColor = 'red';
        }

        // Validar entrenamiento
        if (!entrenamiento) {
            valid = false;
            const msg = form.querySelector('#id_entrenamiento_fk + .error-message');
            msg.textContent = 'Debe seleccionar un entrenamiento.';
            msg.style.display = 'block';
            form.id_entrenamiento_fk.style.borderColor = 'red';
        }

        if (valid) {
            form.submit();
        } else {
            notyf.error('Corrige los errores antes de enviar.');
        }
    });

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
