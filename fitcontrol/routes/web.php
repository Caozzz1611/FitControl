<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\EstadisticaPartidoController;
use App\Http\Controllers\EntrenamientoController;
use App\Http\Controllers\RendimientoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\AsistenciaEntrenamientoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\InscripcionEquipoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('../view', function () {
    return view('welcome');
});



Route::get('/', function () {
    return view('home');
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
      ->parameters(['notificaciones' => 'notificacion:id_notificacion']);
      
Route::resource('historial', HistorialMedicoController::class);


Route::resource('equipo', EquipoController::class);


Route::resource('torneo', TorneoController::class)->except(['show']);

Route::resource('partido', PartidoController::class);


Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.index');
Route::get('/calendario/eventos', [CalendarioController::class, 'eventos'])->name('calendario.eventos');



use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/* // Rutas protegidas por el middleware 'auth'
Route::middleware(['auth'])->group(function () {

    // Grupo de rutas para el rol 'admin'
  

    // Grupo de rutas para el rol 'jugador'
    Route::middleware(['role:jugador'])->group(function () {
        Route::get('/jugador', function () {
            return "Bienvenido Jugador";
        })->name('dashboard.jugador');
    });

    // Grupo de rutas para el rol 'entrenador'
    Route::middleware(['role:entrenador'])->group(function () {
        Route::get('/entrenador', function () {
            return "Bienvenido Entrenador";
        })->name('dashboard.entrenador');
    });

}); */


use App\Http\Middleware\RoleMiddleware; // Asegúrate de importar tu clase

Route::middleware(['auth'])->group(function () {

/* Route::get('/admin', function () {
    return view('dashboard');
})->name('dashboard');
 */

    // O, mejor, usa una cadena de alias si lo prefieres
    Route::middleware([RoleMiddleware::class . ':jugador'])->group(function () {
        Route::get('/jugador', function () {
            return view('jugador.dashboard');
        })->name('jugador.dashboard');
    });

Route::get('/entrenador', function () {
    return view('entrenador.dashboard');
})->name('entrenador.dashboard');

});



Route::resource('estadistica_partido', EstadisticaPartidoController::class);


Route::resource('entrenamiento', EntrenamientoController::class);


Route::resource('rendimiento', RendimientoController::class);

Route::resource('pago', PagoController::class);
// Para crear un nuevo pago
Route::get('/pago/create', [PagoController::class, 'create'])->name('pago.create');

// Para guardar el pago
Route::post('/pago', [PagoController::class, 'store'])->name('pago.store');

// Para listar pagos (si tienes lista)
Route::get('/pago', [PagoController::class, 'index'])->name('pago.index');


Route::resource('asistencia_entrenamiento', AsistenciaEntrenamientoController::class);

Route::resource('inscripcion', InscripcionController::class);

Route::resource('inscripcion_equipo', InscripcionEquipoController::class);
Route::get('/usuarios/pdf', [PdfController::class, 'downloadUsuarios'])->name('usuarios.pdf');


Route::get('/equipos/pdf', [PdfController::class, 'downloadEquipos'])->name('equipos.pdf');


Route::get('/pagos/pdf', [PdfController::class, 'downloadPagos'])->name('pagos.pdf');

Route::get('/torneo/pdf', [PdfController::class, 'downloadTorneos'])->name('torneo.pdf');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


//rutas para excels

Route::get('/partidos/export', [App\Http\Controllers\PartidoController::class, 'exportExcel'])
     ->name('partidos.export');

Route::get('/historial_medico/export', [HistorialMedicoController::class, 'export'])
    ->name('historial_medico.export');

Route::get('/entrenamientos/export', [EntrenamientoController::class, 'export'])->name('entrenamientos.export');

Route::get('/asistencias/export', [AsistenciaEntrenamientoController::class, 'export'])->name('asistencias.export');
