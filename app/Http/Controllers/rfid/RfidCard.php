<?php

namespace App\Http\Controllers\rfid;

use Illuminate\Http\Request;
use App\Models\TemporaryRfid;
use App\Http\Controllers\Controller;

class RfidCard extends Controller
{
    public function kirimKartu($nokartu)
    {
        TemporaryRfid::truncate(); // Menghapus semua data TemporaryRfid
        $simpan = TemporaryRfid::create([
            'no_kartu' => $nokartu // Menyimpan nomor kartu yang diterima dari URL ke dalam database
        ]);

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kartu berhasil dikirim'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Kartu gagal dikirim'
            ]);
        }
    }
}
