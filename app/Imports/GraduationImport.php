<?php

namespace App\Imports;

use App\Models\Graduation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GraduationImport implements ToModel, WithHeadingRow
{

    /**
     * Map each row to a Graduation model.
     * Kolom Excel yang diharapkan (header row):
     *   name | npm | major | year | status_job | status_major_now
     */
    public function model(array $row): ?Graduation
    {
        // Lewati baris jika npm kosong
        if (empty($row['npm'])) {
            return null;
        }

        // Cek apakah NPM sudah terdaftar di database
        $existing = Graduation::where('npm', $row['npm'])->first();
        if ($existing) {
            // Lemparkan pesan error dengan nama dan NPM yang sudah terdaftar
            throw new \Exception("Gagal Import: Data alumni sudah terdaftar atas nama '{$existing->name}' dengan NPM '{$existing->npm}'.");
        }

        return new Graduation([
            'name'             => $row['name']             ?? null,
            'npm'              => $row['npm']              ?? null,
            'major'            => $row['major']            ?? null,
            'year'             => $row['year']             ?? null,
            'status_job'       => $row['status_job']       ?? null,
            'status_major_now' => $row['status_major_now'] ?? null,
            'photo'            => null,
        ]);
    }
}
