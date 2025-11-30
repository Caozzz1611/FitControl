<?php

namespace App\Exports;

use App\Models\AsistenciaEntrenamiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AsistenciaEntrenamientoExport implements FromCollection, WithHeadings, WithMapping
{
    protected $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId; // Para filtrar por entrenador si se desea
    }

    public function collection()
    {
        $query = AsistenciaEntrenamiento::with(['entrenamiento', 'jugador']);

        // Si es entrenador, solo mostrar sus entrenamientos
        if ($this->userId) {
            $query->whereHas('entrenamiento', function($q) {
                $q->where('id_entrenador_fk', $this->userId);
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID Asistencia',
            'Fecha Entrenamiento',
            'Hora Entrenamiento',
            'Jugador',
            'Asistió',
        ];
    }

    public function map($asistencia): array
    {
        return [
            $asistencia->id_asistencia,
            $asistencia->entrenamiento?->fecha ?? '-',
            $asistencia->entrenamiento?->hora ?? '-',
            $asistencia->jugador?->nombre ?? '-',
            $asistencia->asistio ? 'Sí' : 'No',
        ];
    }
}
