@extends('layouts.app')

@section('title', 'Editar Historial Médico')

@section('content')
    <form action="{{ route('historial.update', $historial->id_historial) }}" method="POST">
        @csrf
        @method('PUT')
        @include('historial.form')
    </form>
@endsection
