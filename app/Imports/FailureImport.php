<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Failure;

class FailureImport implements ToModel
{
    public function model(array $row)
    {
        if ($row[0] == 'No') {
            return null;
        }

        if ($row[0] == null) {
            return null;
        }

        if (Failure::where('number', $row[1])->first()) {
            return null;
        }

        return new Failure([
            'number' => $row[1],
            'holder' => trim($row[3]),
            'subtotal' => $row[4],
            'discount' => $row[6],
            'tax' => (int) $row[7],
            'freight' => $row[8] ?? 0,
            'total' => $row[9],
            'paid' => $row[10],
            'signed' => $row[11],
            'rating' => $row[12],
            'note' => $row[13],
            'created_at' => $row[2],
        ]);
    }
}
