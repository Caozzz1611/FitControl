<?php

namespace App\Exports;

use App\Models\Partido;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PartidosExport implements FromCollection, WithHeadings
{
    // Devuelve la colección de datos que queremos exportar
    public function collection()
    {
        return Partido::select(
            'id_partido',
            'fecha',
            'hora',
            'rival',
            'resultado',
            'id_torneo_fk',
            'id_equipo_fk'
        )->get();
    }

    // Encabezados de columnas
    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Hora',
            'Rival',
            'Resultado',
            'Torneo ID',
            'Equipo ID'
        ];
    }
}
