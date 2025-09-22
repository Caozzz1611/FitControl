<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Equipo;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pago;
use App\Models\Torneo;

class PdfController extends Controller
{
     // Método para descargar el PDF de los usuarios
    public function downloadUsuarios()
    {
        $usuarios = Usuario::all();  // Trae todos los usuarios de la base de datos
        $pdf = Pdf::loadView('usuarios.pdf', compact('usuarios'));  // Genera el PDF a partir de la vista
        return $pdf->download('usuarios.pdf');  // Descarga el PDF generado
    }
    public function downloadEquipos()
    {
        $equipos = Equipo::all();
        $pdf = Pdf::loadView('equipo.pdf', compact('equipos'));
        return $pdf->download('equipos.pdf');
    }

    public function downloadPagos()
    {
        $pagos = Pago::all();
        $pdf = Pdf::loadView('pago.pdf', compact('pagos'));
        return $pdf->download('pagos.pdf');
    }
   public function downloadTorneos()
{
    $torneos = Torneo::with('equipo')->get();
    $pdf = Pdf::loadView('torneo.pdf', compact('torneos'));
    return $pdf->download('torneos.pdf');
}

}
