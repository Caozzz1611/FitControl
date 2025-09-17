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
    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" name="fecha" value="{{ old('fecha', optional($entrenamiento)->fecha) }}" required>
</div>

<div class="form-group">
    <label for="hora">Hora</label>
    <input type="time" id="hora" name="hora" value="{{ old('hora', optional($entrenamiento)->hora) }}" required>
</div>

<div class="form-group">
    <label for="ubicacion">Ubicación</label>
    <input type="text" id="ubicacion" name="ubicacion" value="{{ old('ubicacion', optional($entrenamiento)->ubicacion) }}" required>
</div>

<div class="form-group">
    <label for="id_equipo_fk">Equipo</label>
    <select id="id_equipo_fk" name="id_equipo_fk" required>
        <option value="">-- Selecciona un equipo --</option>
        @foreach($equipos as $equipo)
            <option value="{{ $equipo->id_equipo }}"
                {{ old('id_equipo_fk', optional($entrenamiento)->id_equipo_fk) == $equipo->id_equipo ? 'selected' : '' }}>
                {{ $equipo->nombre_equipo }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit">Guardar</button>

<a href="{{ url()->previous() }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
