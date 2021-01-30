<?php

namespace App\Imports;

use App\Models\Catalogo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class AbiesImport implements ToModel, WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {

        return new Catalogo([
            'autor' => $row[1],
            'titulo' => $row[47],
            'editorial' => $row[9],
            'anopub' => $row[0],
            'ejemplar' => $row[3],
            'isbn' => $row[18],
        ]);

    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ";",
        ];
    }
}
