<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;

class GuruImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Guru([
            'nama_lengkap' => $row[2],
            'sekolah_id' => $row[3],
            'email' => $row[4],
            'jenis_kelamin' => $row[5],
            'no_hp' => $row[6],
            'nip' => $row[7],
        ]);
    }
}
