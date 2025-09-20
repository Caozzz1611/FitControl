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

<div class="form-group">
    <label>Goles</label>
    <input type="number" name="goles" min="0" value="{{ old('goles', optional($estadistica)->goles) }}" required>
    <span class="hint">Ingrese la cantidad de goles anotados por el jugador en el partido.</span>
</div>

<div class="form-group">
    <label>Asistencias</label>
    <input type="number" name="asistencias" min="0" value="{{ old('asistencias', optional($estadistica)->asistencias) }}" required>
    <span class="hint">Ingrese la cantidad de asistencias realizadas por el jugador.</span>
</div>

<div class="form-group">
    <label>Tarjetas Amarillas</label>
    <input type="number" name="tarjetas_amarillas" min="0" value="{{ old('tarjetas_amarillas', optional($estadistica)->tarjetas_amarillas) }}" required>
    <span class="hint">Ingrese la cantidad de tarjetas amarillas recibidas por el jugador.</span>
</div>

<div class="form-group">
    <label>Tarjetas Rojas</label>
    <input type="number" name="tarjetas_rojas" min="0" value="{{ old('tarjetas_rojas', optional($estadistica)->tarjetas_rojas) }}" required>
    <span class="hint">Ingrese la cantidad de tarjetas rojas recibidas por el jugador.</span>
</div>

<div class="form-group">
    <label>Partido</label>
    <select name="id_partido_fk" required>
        <option value="">-- Selecciona un partido --</option>
        @foreach($partidos as $partido)
            <option value="{{ $partido->id_partido }}"
                {{ old('id_partido_fk', optional($estadistica)->id_partido_fk) == $partido->id_partido ? 'selected' : '' }}>
                {{ $partido->fecha }} - vs {{ $partido->rival }}
            </option>
        @endforeach
    </select>
    <span class="hint">Seleccione el partido correspondiente a estas estadísticas.</span>
</div>

<div class="form-group">
    <label>Jugador</label>
    <select name="id_usu_fk" required>
        <option value="">-- Selecciona un jugador --</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id_usu }}"
                {{ old('id_usu_fk', optional($estadistica)->id_usu_fk) == $usuario->id_usu ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>
    <span class="hint">Seleccione el jugador al que corresponden estas estadísticas.</span>
</div>

<button type="submit">Guardar</button>

<a href="{{ url()->previous() }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
