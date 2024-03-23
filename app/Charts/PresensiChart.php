<?php

namespace App\Charts;

use App\Models\PresensiSholat;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PresensiChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            $sekolah = $admin->sekolah;

            $tanggal = date('Y-m-d');
            $presensi = PresensiSholat::where('sekolah_id', $sekolah->id)->where('tanggal', $tanggal)->get();

            // Menghitung jumlah seluruh siswa yang melaksanakan sholat
            $totalPresensiSiswa = $presensi->count();

            // Menghitung jumlah siswa laki-laki yang melaksanakan sholat
            $totalPresensiSiswaLaki = $presensi->where('siswa.jenis_kelamin', 'L')->count();

            // Menghitung jumlah siswa perempuan yang melaksanakan sholat
            $totalPresensiSiswaPerempuan = $presensi->where('siswa.jenis_kelamin', 'P')->count();

            if ($totalPresensiSiswa == 0) {
                return $this->chart->pieChart()
                    ->addData([0, 0])
                    ->setWidth(504)
                    ->setHeight(504)
                    ->setColors(["#696CFF", "#FF9561"])
                    ->setLabels(['Laki-laki', 'Perempuan']);
            } else {
                return $this->chart->pieChart()
                    ->addData([$totalPresensiSiswaLaki, $totalPresensiSiswaPerempuan])
                    ->setWidth(504)
                    ->setHeight(504)
                    ->setColors(["#696CFF", "#FF9561"])
                    ->setLabels(['Laki-laki', 'Perempuan']);
            }
        }
    }
}
