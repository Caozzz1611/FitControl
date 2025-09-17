<style>
.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input, select {
    width: 100%;
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

button {
    background-color: #007bff;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

button:hover {
    background-color: #0056b3;
}

.btn-back {
    display: inline-block;
    margin-top: 10px;
    background: #6c757d;
    color: #fff;
    padding: 10px 14px;
    border-radius: 6px;
    text-decoration: none;
}

.btn-back:hover {
    background: #5a6268;
}
</style>

<div class="form-group">
    <label for="id_usu_fk">Usuario</label>
    <select id="id_usu_fk" name="id_usu_fk" required>
        <option value="">-- Selecciona un usuario --</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id_usu }}"
                {{ old('id_usu_fk', optional($inscripcion)->id_usu_fk) == $usuario->id_usu ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="id_torneo_fk">Torneo</label>
    <select id="id_torneo_fk" name="id_torneo_fk" required>
        <option value="">-- Selecciona un torneo --</option>
        @foreach($torneos as $torneo)
            <option value="{{ $torneo->id_torneo }}"
                {{ old('id_torneo_fk', optional($inscripcion)->id_torneo_fk) == $torneo->id_torneo ? 'selected' : '' }}>
                {{ $torneo->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="fecha_inscripcion">Fecha Inscripción</label>
    <input type="date" id="fecha_inscripcion" name="fecha_inscripcion" value="{{ old('fecha_inscripcion', optional($inscripcion)->fecha_inscripcion) }}" required>
</div>

<div class="form-group">
    <label for="estado">Estado</label>
    <input type="text" id="estado" name="estado" value="{{ old('estado', optional($inscripcion)->estado) }}" required maxlength="20" placeholder="Ej: Confirmado, Pendiente">
</div>

<button type="submit">Guardar</button>

<a href="{{ url()->previous() }}" class="btn-back">Volver</a>
