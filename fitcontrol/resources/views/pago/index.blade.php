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

    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('pago.create') }}" id="insert-btn" class="btn-insertar">+ Insertar Pago</a>
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
                        <a href="{{ route('pago.edit', $pago) }}" class="btn-editar">Editar</a>

                        <form id="delete-form-{{ $pago->id_pago }}" action="{{ route('pago.destroy', $pago) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-eliminar" onclick="confirmDelete({{ $pago->id_pago }})">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No hay pagos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
