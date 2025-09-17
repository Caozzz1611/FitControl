@extends('layouts.app')

@section('title', 'Crear Estadística de Partido')

@section('content')
<div class="card">
    <h2>Crear Estadística de Partido</h2>
    <form action="{{ route('estadistica_partido.store') }}" method="POST">
        @csrf
@include('estadistica_partido.form', ['estadistica' => null])
    </form>
</div>
@endsection
