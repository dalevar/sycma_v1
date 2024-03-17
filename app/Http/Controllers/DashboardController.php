<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardAdmin()
    {
        $admin = Auth::guard('admin')->user();
        $sekolah = $admin->sekolah;

        return view('dashboard.pages.admin.dashboard_main.dashboard', compact('admin', 'sekolah'));
    }

    public function dashboardGuru()
    {
        $guru = Auth::guard('web')->user();
        // dd($guru);

        $sekolah = $guru->sekolah;
        // dd($sekolah);

        return view('dashboard.pages.guru.dashboard_main.dashboard', compact('sekolah'));
    }
}
