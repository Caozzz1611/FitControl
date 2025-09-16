<script>
function togglePassword() {
    const input = document.getElementById("contra_usu");
    input.type = input.type === "password" ? "text" : "password";
}
</script>

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
    gap: 25px; /* separa más los campos */
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px; /* espacio adicional abajo */
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
    grid-column: span 3; /* botón ocupa toda la fila */
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
.password-wrapper .input-container {
    position: relative;
    display: flex;
    align-items: center;
}

.password-wrapper input {
    width: 100%;
    padding-right: 40px; /* espacio para el ojito */
}

.password-wrapper .toggle-password {
    position: absolute;
    right: 12px;
    cursor: pointer;
    font-size: 18px;
    color: #555;
    user-select: none;
    transition: color 0.3s ease;
}

.password-wrapper .toggle-password:hover {
    color: #007bff;
}


</style>


<div class="form-group">
    <label>Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', optional($usuario)->nombre) }}">
</div>

<div class="form-group">
    <label>Apellido</label>
    <input type="text" name="apellido" value="{{ old('apellido', optional($usuario)->apellido) }}">
</div>

<div class="form-group">
    <label>Dirección</label>
    <input type="text" name="direccion" value="{{ old('direccion', optional($usuario)->direccion) }}">
</div>

<div class="form-group">
    <label>Edad</label>
    <input type="number" name="edad" value="{{ old('edad', optional($usuario)->edad) }}">
</div>

<div class="form-group">
    <label>Foto de Perfil</label>
    <input type="file" name="foto_perfil">
    @if(optional($usuario)->foto_perfil)
        <img src="{{ asset('storage/'.optional($usuario)->foto_perfil) }}" width="100">
    @endif
</div>

<div class="form-group">
    <label>Posición</label>
    <input type="text" name="posicion" value="{{ old('posicion', optional($usuario)->posicion) }}">
</div>

<div class="form-group">
    <label>Categoría</label>
    <input type="text" name="categoria" value="{{ old('categoria', optional($usuario)->categoria) }}">
</div>

<div class="form-group">
    <label>Documento Identidad</label>
    <input type="text" name="documento_identidad" value="{{ old('documento_identidad', optional($usuario)->documento_identidad) }}">
</div>

<div class="form-group">
    <label>Teléfono</label>
    <input type="text" name="tel_usu" value="{{ old('tel_usu', optional($usuario)->tel_usu) }}">
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email_usu" value="{{ old('email_usu', optional($usuario)->email_usu) }}">
</div>
<div class="form-group password-wrapper">
    <label>Contraseña</label>
    <div class="input-container">
        <input type="password" name="contra_usu" id="contra_usu" placeholder="Confirmar contraseña" required>
        <span class="toggle-password" onclick="togglePassword()">
            👁️
        </span>
    </div>
</div>

<div class="form-group">
    <label>Rol</label>
    <select name="rol" class="form-control">
        <option value="admin" {{ old('rol', $usuario->rol ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="jugador" {{ old('rol', $usuario->rol ?? '') == 'jugador' ? 'selected' : '' }}>Jugador</option>
        <option value="entrenador" {{ old('rol', $usuario->rol ?? '') == 'entrenador' ? 'selected' : '' }}>Entrenador</option>
    </select>
</div>
<a href="{{ url()->previous() }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
