<?php

namespace App\Exports;

use App\Models\Entrenamiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EntrenamientoExport implements FromCollection, WithHeadings, WithMapping
{
    protected $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId; // Si quieres filtrar por entrenador
    }

    public function collection()
    {
        $query = Entrenamiento::query();

        // Si es entrenador, solo mostrar sus entrenamientos
        if ($this->userId) {
            $query->where('id_entrenador_fk', $this->userId);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Hora',
            'Descripción',
            'Entrenador',
        ];
    }

    public function map($entrenamiento): array
    {
        return [
            $entrenamiento->id_entrenamiento,
            $entrenamiento->fecha,
            $entrenamiento->hora,
            $entrenamiento->descripcion,
            $entrenamiento->entrenador?->nombre . ' ' . $entrenamiento->entrenador?->apellido ?? '-',
        ];
    }
}
