@extends('layouts.app')

@section('title', 'Pagos')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notyf = new Notyf({
            duration: 3000,
            position: { x: 'right', y: 'bottom' },
            ripple: true,
        });

        @if(session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            notyf.error("{{ session('error') }}");
        @endif
    });

    function confirmDelete(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

<div class="card">
    <h2>Listado de Pagos</h2>
    <form method="GET" action="{{ route('pago.index') }}" style="margin-bottom: 20px; display: flex; gap: 10px;">
    <!-- Filtro por fecha -->
    <input type="date" name="fecha_pago" value="{{ request('fecha_pago') }}" placeholder="Fecha Pago">

    <!-- Filtro por estado -->
    <select name="estado">
        <option value="">Estado</option>
        <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
        <option value="completado" {{ request('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
        <option value="cancelado" {{ request('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
    </select>

    <!-- Filtro por usuario -->
    <input type="text" name="usuario" value="{{ request('usuario') }}" placeholder="Nombre de Usuario">

    <!-- Botón de Filtrar -->
    <button type="submit">Filtrar</button>

    <!-- Botón de limpiar filtros -->
    <a href="{{ route('pago.index') }}" class="btn-reset">Limpiar</a>
</form>


    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('pago.create') }}" id="insert-btn" class="btn-insertar">+ Insertar Pago</a>
              <x-alert-insert :buttonId="'insert-btn'" />
    </div>

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha Pago</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Recibo PDF</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
      <tbody>
    @forelse($pagos as $pago)
        <tr>
            <td>{{ $pago->id_pago }}</td>
            <td>{{ $pago->fecha_pago }}</td>
            <td>{{ $pago->monto }}</td>
            <td>{{ ucfirst($pago->estado) }}</td>
            <td>
                @if($pago->recibo_pdf)
                    <a href="{{ asset('storage/' . $pago->recibo_pdf) }}" target="_blank">Ver PDF</a>
                @else
                    -
                @endif
            </td>
            <td>{{ $pago->usuario ? $pago->usuario->nombre . ' ' . $pago->usuario->apellido : '-' }}</td>
            <td>
                <!-- Botón Editar con ID -->
                <a href="{{ route('pago.edit', $pago) }}" id="edit-btn-{{ $pago->id_pago }}" class="btn-editar">Editar</a>
                <!-- Alerta asociada al botón Editar -->
                <x-alert-edit :buttonId="'edit-btn-'.$pago->id_pago" />

                <!-- Formulario de eliminar -->
                <form id="delete-form-{{ $pago->id_pago }}" action="{{ route('pago.destroy', $pago) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-eliminar" onclick="confirmDelete({{ $pago->id_pago }})">Eliminar</button>
                </form>
                <!-- Alerta de eliminar (si tu componente necesita formId) -->
                <x-alert-delete :formId="'delete-form-'.$pago->id_pago" />
            </td>
        </tr>
    @empty
        <tr><td colspan="7">No hay pagos registrados.</td></tr>
    @endforelse
</tbody>
    </table>
</div>

@endsection
