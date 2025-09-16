@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="card">
    <h2>Editar Usuario</h2>
    <form action="{{ route('usuarios.update', $usuario->id_usu) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('usuarios.form')
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

</div>
@endsection
