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

<div class="form-group">
    <label for="presente">Presente</label>
    <select id="presente" name="presente" required>
        <option value="">-- Selecciona --</option>
        <option value="1" {{ old('presente', optional($asistencia_entrenamiento)->presente) == 1 ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ old('presente', optional($asistencia_entrenamiento)->presente) == 0 ? 'selected' : '' }}>No</option>
    </select>
    <span class="hint">Indica si el usuario asistió al entrenamiento.</span>
</div>

<div class="form-group">
    <label for="id_usu_fk">Usuario</label>
    <select id="id_usu_fk" name="id_usu_fk" required>
        <option value="">-- Selecciona un usuario --</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id_usu }}"
                {{ old('id_usu_fk', optional($asistencia_entrenamiento)->id_usu_fk) == $usuario->id_usu ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>
    <span class="hint">Selecciona el usuario que corresponde a esta asistencia.</span>
</div>

<div class="form-group">
    <label for="id_entrenamiento_fk">Entrenamiento</label>
    <select id="id_entrenamiento_fk" name="id_entrenamiento_fk" required>
        <option value="">-- Selecciona un entrenamiento --</option>
        @foreach($entrenamientos as $entrenamiento)
            <option value="{{ $entrenamiento->id_entrenamiento }}"
                {{ old('id_entrenamiento_fk', optional($asistencia_entrenamiento)->id_entrenamiento_fk) == $entrenamiento->id_entrenamiento ? 'selected' : '' }}>
                {{ $entrenamiento->fecha }} - {{ $entrenamiento->ubicacion }}
            </option>
        @endforeach
    </select>
    <span class="hint">Selecciona el entrenamiento al que corresponde esta asistencia.</span>
</div>

<button type="submit">Guardar</button>

<a href="{{ route('asistencia_entrenamiento.index') }}" class="btn-back">Volver</a>
