@extends('layouts.app')

@section('title', 'Editar Torneo')

@section('content')
<div class="card">
    <h2>Editar Torneo</h2>
    <form action="{{ route('torneo.update', $torneo->id_torneo) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('torneo.form')
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

</div>
@endsection
