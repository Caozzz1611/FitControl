<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Equipo;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pago;

class PdfController extends Controller
{
    public function downloadUsuarios()
    {
        $usuarios = Usuario::all();
        $pdf = Pdf::loadView('usuarios.pdf', compact('usuarios'));
        return $pdf->download('usuarios.pdf');
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
}
