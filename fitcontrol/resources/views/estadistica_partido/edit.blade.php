@extends('layouts.app')

@section('title', 'Editar Estadística')

@section('content')
<div class="card">
    <h2>Editar Estadística de Partido</h2>
    <form action="{{ route('estadistica_partido.update', $estadistica->id_estadistica) }}" method="POST">
        @csrf
        @method('PUT')
        @include('estadistica_partido.form')
    </form>
</div>
@endsection
