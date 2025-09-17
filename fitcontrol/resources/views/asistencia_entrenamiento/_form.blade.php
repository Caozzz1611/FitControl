<style>
/* Usa el mismo estilo que el formulario de entrenamientos */
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
.form-group select {
    padding: 12px 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
    width: 100%;
}
button {
    background: #007bff;
    color: white;
    padding: 14px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
}
button:hover {
    background: #0056b3;
}
.btn-back {
    margin-top: 10px;
    background: #6c757d;
    color: white;
    padding: 12px 14px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
}
.btn-back:hover {
    background: #5a6268;
}
</style>

<div class="form-group">
    <label for="presente">Presente</label>
    <select id="presente" name="presente" required>
        <option value="">-- Selecciona --</option>
        <option value="1" {{ old('presente', optional($asistencia_entrenamiento)->presente) == 1 ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ old('presente', optional($asistencia_entrenamiento)->presente) == 0 ? 'selected' : '' }}>No</option>
    </select>
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
</div>

<button type="submit">Guardar</button>

<a href="{{ route('asistencia_entrenamiento.index') }}" class="btn-back">Volver</a>
