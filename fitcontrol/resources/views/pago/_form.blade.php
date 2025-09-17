<div class="form-group">
    <label for="fecha_pago">Fecha de Pago</label>
    <input type="date" id="fecha_pago" name="fecha_pago" value="{{ old('fecha_pago', $pago->fecha_pago ?? '') }}" required>
</div>

<div class="form-group">
    <label for="monto">Monto</label>
    <input type="number" step="0.01" id="monto" name="monto" value="{{ old('monto', $pago->monto ?? '') }}" required>
</div>

<div class="form-group">
    <label for="estado">Estado</label>
    <select id="estado" name="estado" required>
        <option value="">-- Selecciona un estado --</option>
        <option value="pagado" {{ old('estado', $pago->estado ?? '') == 'pagado' ? 'selected' : '' }}>Pagado</option>
        <option value="completado" {{ old('estado', $pago->estado ?? '') == 'completado' ? 'selected' : '' }}>Completado</option>
        <option value="pendiente" {{ old('estado', $pago->estado ?? '') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
    </select>
</div>

<div class="form-group">
    <label for="id_usu_fk">Usuario</label>
    <select id="id_usu_fk" name="id_usu_fk" required>
        <option value="">-- Selecciona un usuario --</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id_usu }}" {{ old('id_usu_fk', $pago->id_usu_fk ?? '') == $usuario->id_usu ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="recibo_pdf">Recibo PDF</label>

    @if(isset($pago) && $pago->recibo_pdf)
        <p>Recibo actual:</p>
        <a href="{{ asset('storage/' . $pago->recibo_pdf) }}" target="_blank">Ver Recibo PDF</a>
        <embed src="{{ asset('storage/' . $pago->recibo_pdf) }}" type="application/pdf" width="100%" height="400px" />
    @endif

    <input type="file" name="recibo_pdf" id="recibo_pdf" accept="application/pdf" />
</div>

<button type="submit">Guardar</button>

<a href="{{ url()->previous() }}" class="btn-back">Volver</a>
