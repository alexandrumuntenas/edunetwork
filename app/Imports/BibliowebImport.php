<?php

namespace App\Imports;

use App\Models\Catalogo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class BibliowebImport implements ToModel, WithCustomCsvSettings
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Catalogo([
            'autor' => $row[7],
            'titulo' => $row[6],
            'ejemplar' => $row[3],
            'isbn' => $row[4],
            'ubicacion' => $row[12],
        ]);
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ",",
        ];
    }
}
