<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\CalendarioController;



Route::get('../view', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/reportes', function () {
    return view('reportes');
})->name('reportes');


Route::get('/usuarios/pdf', [PdfController::class, 'download'])->name('usuarios.pdf');



Route::resource('usuarios', UsuarioController::class);



Route::resource('notificaciones', NotificacionController::class)
    ->parameters(['notificaciones' => 'notificacion']); // <-- aquí cambiamos el parámetro


Route::resource('historial', HistorialMedicoController::class);


Route::resource('equipo', EquipoController::class);


Route::resource('torneo', TorneoController::class);

Route::resource('partido', PartidoController::class);


Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.index');
Route::get('/calendario/eventos', [CalendarioController::class, 'eventos'])->name('calendario.eventos');







