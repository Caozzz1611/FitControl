<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function download()
    {
        $usuarios = Usuario::all();
        $pdf = Pdf::loadView('usuarios.pdf', compact('usuarios'));
        return $pdf->download('usuarios.pdf'); // fuerza la descarga
    }
}
