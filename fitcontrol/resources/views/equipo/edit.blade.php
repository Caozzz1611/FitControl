@extends('layouts.app')

@section('title', 'Editar Equipo')

@section('content')
    <form action="{{ route('equipo.update', $equipo->id_equipo) }}" method="POST">
        @csrf
        @method('PUT')
        @include('equipo.form', ['equipo' => $equipo])
    </form>
@endsection
