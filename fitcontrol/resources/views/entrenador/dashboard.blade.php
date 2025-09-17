@extends('layouts.app-two') 

@section('title', 'Dashboard Entrenador')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">Panel de Control del Entrenador</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">Mi Equipo</h2>
                <p>Aquí puedes ver el estado y la información de tu equipo.</p>
                <a href="{{ route('equipo.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Ver Equipo</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">Próximos Partidos</h2>
                <p>Revisa los detalles y la hora de los próximos partidos.</p>
                <a href="{{ route('partido.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Ver Partidos</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">Estadísticas Clave</h2>
                <p>Analiza el rendimiento de tus jugadores y del equipo.</p>
                <a href="{{ route('usuarios.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Ver Rendimiento</a>
            </div>
        </div>
    </div>
@endsection