<style>
form {
    max-width: 800px;
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
}

button {
    grid-column: span 2;
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
    grid-column: span 2;
    display: inline-block;
    margin-top: 10px;
    padding: 12px 14px;
    background: #6c757d;
    color: #fff;
    border-radius: 8px;
    font-size: 14px;
    text-decoration: none;
    text-align: center;
    transition: background 0.3s ease;
}

.btn-back:hover {
    background: #5a6268;
}
</style>

<div class="form-group">
    <label>Goles</label>
    <input type="number" name="goles" min="0" value="{{ old('goles', optional($estadistica)->goles) }}" required>
</div>

<div class="form-group">
    <label>Asistencias</label>
    <input type="number" name="asistencias" min="0" value="{{ old('asistencias', optional($estadistica)->asistencias) }}" required>
</div>

<div class="form-group">
    <label>Tarjetas Amarillas</label>
    <input type="number" name="tarjetas_amarillas" min="0" value="{{ old('tarjetas_amarillas', optional($estadistica)->tarjetas_amarillas) }}" required>
</div>

<div class="form-group">
    <label>Tarjetas Rojas</label>
    <input type="number" name="tarjetas_rojas" min="0" value="{{ old('tarjetas_rojas', optional($estadistica)->tarjetas_rojas) }}" required>
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
</div>

<button type="submit">Guardar</button>

<a href="{{ url()->previous() }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
