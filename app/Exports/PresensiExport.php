<?php

namespace App\Exports;

use App\Models\PresensiSholat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PresensiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PresensiSholat::with('siswa')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Tanggal Sholat',
            'Sekolah',
            'Nama Siswa',
            'No Kartu',
            'Tanggal',
            'Waktu Sholat',
            'Jam Sholat',
            'Jenis Sholat',
            'Status'
        ];
    }
}
