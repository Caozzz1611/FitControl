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

        /* estilos para el toggle de contraseña (ojito) */
        .password-wrapper .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 44px; /* espacio para el ojito */
        }

        .password-wrapper .toggle-password {
            position: absolute;
            right: 12px;
            cursor: pointer;
            font-size: 18px;
            color: #555;
            user-select: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 6px;
        }

        .password-wrapper .toggle-password:hover {
            color: #007bff;
            background: rgba(0,123,255,0.05);
        }

        .btn-back {
            grid-column: span 3;
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>


<div class="form-group">
    <label for="fecha_pago">Fecha de Pago</label>
    <input type="date" id="fecha_pago" name="fecha_pago" value="{{ old('fecha_pago', $pago->fecha_pago ?? '') }}" required>
    <span class="hint">Seleccione la fecha en que se realizó el pago.</span>
</div>

<div class="form-group">
    <label for="monto">Monto</label>
    <input type="number" step="0.01" id="monto" name="monto" value="{{ old('monto', $pago->monto ?? '') }}" required>
    <span class="hint">Ingrese el monto total del pago (ej: 120.50).</span>
</div>

<div class="form-group">
    <label for="estado">Estado</label>
    <select id="estado" name="estado" required>
        <option value="">-- Selecciona un estado --</option>
        <option value="pagado" {{ old('estado', $pago->estado ?? '') == 'pagado' ? 'selected' : '' }}>Pagado</option>
        <option value="completado" {{ old('estado', $pago->estado ?? '') == 'completado' ? 'selected' : '' }}>Completado</option>
        <option value="pendiente" {{ old('estado', $pago->estado ?? '') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
    </select>
    <span class="hint">Seleccione el estado actual del pago.</span>
</div>

<div class="form-group">
    <label for="id_usu_fk">Usuario</label>
    <select id="id_usu_fk" name="id_usu_fk" required>
        <option value="">-- Selecciona un usuario --</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id_usu }}" {{ old('id_usu_fk', $pago->id_usu_fk ?? '') == $usuario->id_usu ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>
    <span class="hint">Seleccione el usuario al que corresponde este pago.</span>
</div>

<div class="form-group">
    <label for="recibo_pdf">Recibo PDF</label>

    @if(isset($pago) && $pago->recibo_pdf)
        <p>Recibo actual:</p>
        <a href="{{ asset('storage/' . $pago->recibo_pdf) }}" target="_blank">Ver Recibo PDF</a>
        <embed src="{{ asset('storage/' . $pago->recibo_pdf) }}" type="application/pdf" width="100%" height="400px" />
    @endif

    <input type="file" name="recibo_pdf" id="recibo_pdf" accept="application/pdf" />
    <span class="hint">Suba el recibo en formato PDF (opcional si ya existe uno).</span>
</div>

<button type="submit">Guardar</button>

<a href="{{ url()->previous() }}" class="btn-back">Volver</a>
