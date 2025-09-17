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
</div>

<div class="form-group">
    <label for="fecha_inscripcion">Fecha de inscripción</label>
    <input type="date" name="fecha_inscripcion" id="fecha_inscripcion" value="{{ old('fecha_inscripcion', $inscripcion_equipo->fecha_inscripcion ?? '') }}" required>
</div>

<div class="form-group">
    <label for="estado">Estado</label>
    <input type="text" name="estado" id="estado" value="{{ old('estado', $inscripcion_equipo->estado ?? '') }}" maxlength="20" required>
</div>

<button type="submit">Guardar</button>

<a href="{{ url()->previous() }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
