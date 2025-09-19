
<div class="form-group">
    <label>Fecha</label>
    <input type="date" name="fecha" value="{{ old('fecha', optional($partido)->fecha) }}" required>
</div>

<div class="form-group">
    <label>Hora</label>
    <input type="time" name="hora" value="{{ old('hora', optional($partido)->hora) }}" required>
</div>

<div class="form-group">
    <label>Rival</label>
    <input type="text" name="rival" value="{{ old('rival', optional($partido)->rival) }}" required>
</div>

<div class="form-group">
    <label>Resultado</label>
    <input type="text" name="resultado" value="{{ old('resultado', optional($partido)->resultado) }}">
</div>

<div class="form-group">
    <label>Torneo</label>
    <select name="id_torneo_fk" required>
        <option value="">-- Selecciona un torneo --</option>
        @foreach($torneos as $torneo)
            <option value="{{ $torneo->id_torneo }}"
                {{ old('id_torneo_fk', optional($partido)->id_torneo_fk) == $torneo->id_torneo ? 'selected' : '' }}>
                {{ $torneo->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Equipo</label>
    <select name="id_equipo_fk" required>
        <option value="">-- Selecciona un equipo --</option>
        @foreach($equipos as $equipo)
            <option value="{{ $equipo->id_equipo }}"
                {{ old('id_equipo_fk', optional($partido)->id_equipo_fk) == $equipo->id_equipo ? 'selected' : '' }}>
                {{ $equipo->nombre_equipo }}
            </option>
        @endforeach
    </select>
</div>
