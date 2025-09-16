@extends('layouts.app')

@section('title', 'Nuevo Equipo')

@section('content')
    <form action="{{ route('equipo.store') }}" method="POST">
        @csrf
        @include('equipo.form', ['equipo' => null])
    </form>
@endsection
