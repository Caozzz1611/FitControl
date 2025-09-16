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
</style>

<div class="form-group">
    <label>Título</label>
    <input type="text" name="titulo" value="{{ old('titulo', optional($notificacion)->titulo) }}" required>
</div>

<div class="form-group">
    <label>Mensaje</label>
    <textarea name="mensaje" rows="4" required>{{ old('mensaje', optional($notificacion)->mensaje) }}</textarea>
</div>

<div class="form-group">
    <label>Fecha</label>
    <input type="datetime-local" name="fecha"
           value="{{ old('fecha', optional($notificacion)->fecha ? date('Y-m-d\TH:i', strtotime($notificacion->fecha)) : '') }}"
           required>
</div>

<div class="form-group">
    <label>Usuario Destinatario</label>
    <select name="id_usuario_destinatario_fk" required>
        <option value="">-- Selecciona un usuario --</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id_usu }}"
                {{ old('id_usuario_destinatario_fk', optional($notificacion)->id_usuario_destinatario_fk) == $usuario->id_usu ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit">Guardar</button>
<a href="{{ url()->previous() }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
