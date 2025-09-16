@extends('layouts.app')

@section('title', 'Calendario de Partidos')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">📅 Calendario de Partidos</h2>

    <div class="bg-white rounded-2xl shadow-xl p-6">
        <div id="calendar"></div>
    </div>
</div>

<!-- Modal -->
<div id="modalPartido" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-96 p-6">
        <h3 class="text-2xl font-bold text-indigo-600 mb-4">⚽ Detalles del Partido</h3>
        <div class="space-y-2 text-gray-700">
            <p><strong>Equipo:</strong> <span id="modalEquipo"></span></p>
            <p><strong>Rival:</strong> <span id="modalRival"></span></p>
            <p><strong>Fecha:</strong> <span id="modalFecha"></span></p>
            <p><strong>Hora:</strong> <span id="modalHora"></span></p>
        </div>
        <div class="mt-6 text-right">
            <button onclick="cerrarModal()" 
                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg shadow-md transition">
                Cerrar
            </button>
        </div>
    </div>
</div>

<!-- FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        height: "auto",
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            list: 'Lista'
        },
        events: "{{ route('calendario.eventos') }}",

        // 🎨 Estilos personalizados para los partidos
        eventDidMount: function(info) {
            info.el.classList.add(
                'bg-indigo-500',
                'hover:bg-indigo-600',
                'text-white',
                'rounded-xl',
                'px-3',
                'py-1',
                'shadow-lg',
                'transition',
                'duration-200',
                'ease-in-out',
                'cursor-pointer',
                'text-sm',
                'font-medium'
            );
        },

        // 📌 Abrir modal con detalles
        eventClick: function(info) {
            document.getElementById("modalEquipo").innerText = info.event.extendedProps.equipo ?? "N/A";
            document.getElementById("modalRival").innerText = info.event.extendedProps.rival ?? "N/A";
            document.getElementById("modalFecha").innerText = new Date(info.event.start).toLocaleDateString("es-ES", {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });
            document.getElementById("modalHora").innerText = new Date(info.event.start).toLocaleTimeString([], {
                hour: '2-digit', minute:'2-digit'
            });

            document.getElementById("modalPartido").classList.remove("hidden");
        }
    });

    calendar.render();
});

// Cerrar modal
function cerrarModal() {
    document.getElementById("modalPartido").classList.add("hidden");
}
</script>
@endsection
