{{-- resources/views/torneo/form.blade.php --}}
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

  .form-group input,
  .form-group textarea,
  .form-group select {
      padding: 12px 14px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      transition: all 0.3s ease;
      width: 100%;
  }

  .form-group input:focus,
  .form-group textarea:focus,
  .form-group select:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0px 0px 6px rgba(0,123,255,0.2);
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

  .btn-back {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 20px;
      background: #6c757d;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s ease;
  }

  .btn-back:hover {
      background: #565e64;
  }
</style>

<div class="form-group">
    <label>Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', optional($torneo)->nombre) }}">
</div>

<div class="form-group">
    <label>Premio</label>
    <input type="number" name="premio" value="{{ old('premio', optional($torneo)->premio) }}">
</div>

<div class="form-group">
    <label>Descripción</label>
    <textarea name="descripcion">{{ old('descripcion', optional($torneo)->descripcion) }}</textarea>
</div>

<div class="form-group">
    <label>Fecha Inicio</label>
    <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', optional($torneo)->fecha_inicio) }}">
</div>

<div class="form-group">
    <label>Fecha Fin</label>
    <input type="date" name="fecha_fin" value="{{ old('fecha_fin', optional($torneo)->fecha_fin) }}">
</div>

<div class="form-group">
    <label>Equipo Asociado</label>
    <select name="id_equipo_fk">
        <option value="">-- Selecciona un equipo --</option>
        @foreach($equipos as $equipo)
            <option value="{{ $equipo->id_equipo }}" {{ old('id_equipo_fk', optional($torneo)->id_equipo_fk) == $equipo->id_equipo ? 'selected' : '' }}>
                {{ $equipo->nombre_equipo }}
            </option>
        @endforeach
    </select>
</div>
