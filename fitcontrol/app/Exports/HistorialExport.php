<?php

namespace App\Exports;

use App\Models\HistorialMedico; // Ajusta según tu modelo real
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistorialExport implements FromCollection, WithHeadings
{
    protected $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        $query = HistorialMedico::with('usuario')->select(
            'id_historial',
            'id_usu_fk',
            'observaciones',
            'fecha'
        );

        if ($this->userId) {
            $query->where('id_usu_fk', $this->userId);
        }

        return $query->get()->map(function($historial){
            return [
                'ID' => $historial->id_historial_medico,
                'Usuario' => $historial->usuario?->nombre . ' ' . $historial->usuario?->apellido ?? '-',
                'Observaciones' => $historial->observaciones,
                'Fecha' => $historial->fecha,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Usuario',
            'Observaciones',
            'Fecha',
        ];
    }
}
