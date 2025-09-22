@extends('layouts.app')

@section('title', isset($pago) ? 'Editar Pago' : 'Crear Pago')

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
        grid-column: span 3;
        display: inline-block;
        margin-top: 10px;
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
    <h1 class="text-2xl font-bold mb-4">{{ isset($pago) ? 'Editar Pago' : 'Nuevo Pago' }}</h1>

    <form id="formPago"
          action="{{ isset($pago) && $pago->id ? route('pago.update', $pago->id) : route('pago.store') }}"
          method="POST"
          enctype="multipart/form-data"
          novalidate>
        @csrf
        @if(isset($pago) && $pago->id)
            @method('PUT')
        @endif

        <!-- Fecha de Pago -->
        <div class="form-group">
            <label for="fecha_pago">Fecha de Pago</label>
            <input type="date" name="fecha_pago" id="fecha_pago" value="{{ old('fecha_pago', $pago->fecha_pago ?? '') }}">
            <span class="error-message"></span>
            <span class="hint">Seleccione la fecha en que se realizó el pago.</span>
        </div>

        <!-- Monto -->
        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" step="0.01" name="monto" id="monto" value="{{ old('monto', $pago->monto ?? '') }}">
            <span class="error-message"></span>
            <span class="hint">Ingrese el monto total del pago (ej: 120.50).</span>
        </div>

        <!-- Estado -->
        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado">
                <option value="">-- Selecciona un estado --</option>
                <option value="pendiente" {{ old('estado', $pago->estado ?? '') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="completado" {{ old('estado', $pago->estado ?? '') == 'completado' ? 'selected' : '' }}>Completado</option>
            </select>
            <span class="error-message"></span>
            <span class="hint">Seleccione el estado del pago.</span>
        </div>

        <!-- Usuario -->
        <div class="form-group">
            <label for="id_usu_fk">Usuario</label>
            <select name="id_usu_fk" id="id_usu_fk">
                <option value="">-- Selecciona un usuario --</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usu }}" {{ old('id_usu_fk', $pago->id_usu_fk ?? '') == $usuario->id_usu ? 'selected' : '' }}>
                        {{ $usuario->nombre }} {{ $usuario->apellido }}
                    </option>
                @endforeach
            </select>
            <span class="error-message"></span>
            <span class="hint">Seleccione el usuario al que corresponde este pago.</span>
        </div>

        <!-- Recibo PDF -->
        <div class="form-group">
            <label for="recibo_pdf">Recibo PDF</label>
            @if(isset($pago) && $pago->recibo_pdf)
                <p>Recibo actual: <a href="{{ asset('storage/' . $pago->recibo_pdf) }}" target="_blank">Ver Recibo PDF</a></p>
                <embed src="{{ asset('storage/' . $pago->recibo_pdf) }}" type="application/pdf" width="100%" height="300px" />
            @endif
            <input type="file" name="recibo_pdf" id="recibo_pdf" accept="application/pdf">
            <span class="error-message"></span>
            <span class="hint">Suba el recibo en formato PDF (opcional si ya existe uno).</span>
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
    const form = document.getElementById('formPago');
    const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let valid = true;

        // Reset error messages and borders
        form.querySelectorAll('.error-message').forEach(msg => {
            msg.textContent = '';
            msg.style.display = 'none';
        });
        form.querySelectorAll('input, select').forEach(input => {
            input.style.borderColor = '#ccc';
        });

        const fecha = form.fecha_pago.value.trim();
        const monto = form.monto.value.trim();
        const estado = form.estado.value.trim();
        const usuario = form.id_usu_fk.value.trim();
        const hoy = new Date();
        hoy.setHours(0,0,0,0);

        // Fecha Pago validation
        if (!fecha) {
            valid = false;
            const msg = form.querySelector('#fecha_pago + .error-message');
            msg.textContent = 'Seleccione una fecha.';
            msg.style.display = 'block';
            form.fecha_pago.style.borderColor = 'red';
        } else if (new Date(fecha) < hoy) {
            valid = false;
            const msg = form.querySelector('#fecha_pago + .error-message');
            msg.textContent = 'La fecha no puede ser anterior a hoy.';
            msg.style.display = 'block';
            form.fecha_pago.style.borderColor = 'red';
        }

        // Monto validation
        if (!monto || isNaN(monto) || parseFloat(monto) <= 0) {
            valid = false;
            const msg = form.querySelector('#monto + .error-message');
            msg.textContent = 'Ingrese un monto válido.';
            msg.style.display = 'block';
            form.monto.style.borderColor = 'red';
        }

        // Estado validation
        if (!estado) {
            valid = false;
            const msg = form.querySelector('#estado + .error-message');
            msg.textContent = 'Seleccione un estado.';
            msg.style.display = 'block';
            form.estado.style.borderColor = 'red';
        }

        // Usuario validation
        if (!usuario) {
            valid = false;
            const msg = form.querySelector('#id_usu_fk + .error-message');
            msg.textContent = 'Seleccione un usuario.';
            msg.style.display = 'block';
            form.id_usu_fk.style.borderColor = 'red';
        }

        if (valid) {
            form.submit();
        } else {
            notyf.error('Por favor, corrija los errores del formulario.');
        }
    });

    // Mostrar notificaciones desde Laravel si existen
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
