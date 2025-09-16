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
}
.form-group label {
    font-weight: bold;
    margin-bottom: 8px;
    font-size: 14px;
    color: #444;
}
.form-group input {
    padding: 12px 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
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
}
button:hover {
    background: #0056b3;
}
.btn-back {
    grid-column: span 2;
    text-decoration: none;
    padding: 12px;
    background: #6c757d;
    color: white;
    border-radius: 8px;
    text-align: center;
}
</style>

<div class="form-group">
    <label>Nombre del Equipo</label>
    <input type="text" name="nombre_equipo" 
           value="{{ old('nombre_equipo', optional($equipo)->nombre_equipo) }}" required>
</div>

<div class="form-group">
    <label>Logo del Equipo (URL o nombre de archivo)</label>
    <input type="text" name="logo_equipo" 
           value="{{ old('logo_equipo', optional($equipo)->logo_equipo) }}">
</div>

<div class="form-group">
    <label>Ubicación</label>
    <input type="text" name="ubi_equipo" 
           value="{{ old('ubi_equipo', optional($equipo)->ubi_equipo) }}">
</div>

<div class="form-group">
    <label>Contacto</label>
    <input type="number" name="contacto_equipo" 
           value="{{ old('contacto_equipo', optional($equipo)->contacto_equipo) }}">
</div>

<div class="form-group">
    <label>Categoría</label>
    <input type="number" name="categoria_equipo" 
           value="{{ old('categoria_equipo', optional($equipo)->categoria_equipo) }}">
</div>

<button type="submit">Guardar</button>
<a href="{{ url()->previous() }}" class="btn-back">← Volver</a>
