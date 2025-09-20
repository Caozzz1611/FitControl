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
            color: #ffffff;
            font-weight: bold;
        }
    </style>

@csrf

<div class="form-group">
    <label for="id_usu_fk">Usuario</label>
    <select name="id_usu_fk" id="id_usu_fk" required>
        <option value="">-- Selecciona un usuario --</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id_usu }}" {{ (old('id_usu_fk', $inscripcion_equipo->id_usu_fk ?? '') == $usuario->id_usu) ? 'selected' : '' }}>
                {{ $usuario->nombre ?? $usuario->email }}
            </option>
        @endforeach
    </select>
    <span class="hint">Seleccione el usuario que se va a inscribir en el equipo.</span>
</div>

<div class="form-group">
    <label for="id_equipo_fk">Equipo</label>
    <select name="id_equipo_fk" id="id_equipo_fk" required>
        <option value="">-- Selecciona un equipo --</option>
        @foreach($equipos as $equipo)
            <option value="{{ $equipo->id_equipo }}" {{ (old('id_equipo_fk', $inscripcion_equipo->id_equipo_fk ?? '') == $equipo->id_equipo) ? 'selected' : '' }}>
                {{ $equipo->nombre_equipo ?? $equipo->nombre }}
            </option>
        @endforeach
    </select>
    <span class="hint">Seleccione el equipo al que pertenece la inscripción.</span>
</div>

<div class="form-group">
    <label for="fecha_inscripcion">Fecha de inscripción</label>
    <input type="date" name="fecha_inscripcion" id="fecha_inscripcion" value="{{ old('fecha_inscripcion', $inscripcion_equipo->fecha_inscripcion ?? '') }}" required>
    <span class="hint">Seleccione la fecha en la que se realizó la inscripción.</span>
</div>

<div class="form-group">
    <label for="estado">Estado</label>
    <input type="text" name="estado" id="estado" value="{{ old('estado', $inscripcion_equipo->estado ?? '') }}" maxlength="20" required>
    <span class="hint">Ingrese el estado de la inscripción (ej: activo, pendiente, cancelado).</span>
</div>

<button type="submit">Guardar</button>

<a href="{{ url()->previous() }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
