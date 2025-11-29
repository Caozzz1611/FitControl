@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

<!-- Incluyendo Notyf -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


<!-- Script para mostrar alertas -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notyf = new Notyf();

        @if(session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            notyf.error("{{ session('error') }}");
        @endif
    });
</script>

<div class="card">
    <h2 class="h2L">Listado de Usuarios</h2>

    
<form action="{{ route('usuarios.index') }}" method="GET" class="input-group mb-3 shadow-sm" autocomplete="off">

    <!-- Buscar nombre, apellido o email -->
    <input type="text" name="search" class="form-control" 
           placeholder="Buscar nombre, apellido o email" 
           value="{{ request('search') }}">

    <!-- Rol -->
    <select name="rol" class="form-select">
        <option value="">Todos los roles</option>
        <option value="admin" {{ request('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="jugador" {{ request('rol') == 'jugador' ? 'selected' : '' }}>Jugador</option>
        <option value="entrenador" {{ request('rol') == 'entrenador' ? 'selected' : '' }}>Entrenador</option>
    </select>

    <!-- Edad mínima -->
    <input type="number" name="edad_min" class="form-control" 
           placeholder="Edad mín" value="{{ request('edad_min') }}">

    <!-- Edad máxima -->
    <input type="number" name="edad_max" class="form-control" 
           placeholder="Edad máx" value="{{ request('edad_max') }}">

    <!-- Botón Filtrar -->
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i>
    </button>

    <!-- Botón Limpiar -->
    <button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise"></i>
        </a>
    </button>

</form>


  {{-- Botón para insertar --}}
    <div style="height: 50px; margin-bottom: 15px;">
       <a href="{{ route('usuarios.create') }}" id="insert-btn" class="btn-insertar">
    + Insertar Usuario
</a>

<x-alert-insert :buttonId="'insert-btn'" />

    </div>
    

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Edad</th>
                <th>Foto</th>
                <th>Posición</th>
                <th>Categoría</th>
                <th>Documento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id_usu }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->apellido }}</td>
                <td>{{ $usuario->direccion }}</td>
                <td>{{ $usuario->edad }}</td>
                <td>
                    @if($usuario->foto_perfil)
                        <img src="{{ asset('storage/'.$usuario->foto_perfil) }}" alt="Foto" width="40" height="40" style="border-radius:50%">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $usuario->posicion }}</td>
                <td>{{ $usuario->categoria }}</td>
                <td>{{ $usuario->documento_identidad }}</td>
                <td>{{ $usuario->tel_usu }}</td>
                <td>{{ $usuario->email_usu }}</td>
                <td>******</td> {{-- No mostramos la contraseña real por seguridad --}}
                <td>{{ $usuario->rol }}</td>
                <td>
            <a href="{{ route('usuarios.edit', $usuario) }}" id="edit-btn-{{ $usuario->id_usu }}" class="btn-editar">
                Editar
            </a>

            <x-alert-edit :buttonId="'edit-btn-'.$usuario->id_usu" />

                            {{-- Formulario de eliminar --}}
                        <form id="delete-form-{{ $usuario->id_usu }}" action="{{ route('usuarios.destroy', $usuario) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-eliminar">
                Eliminar
            </button>
        </form>

        {{-- Llamar al componente SweetAlert y pasar el id del formulario --}}
        <x-alert-delete :formId="'delete-form-'.$usuario->id_usu" />

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

