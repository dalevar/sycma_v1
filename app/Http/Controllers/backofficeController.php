<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class backofficeController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.backoffice_admin.dashboard_main.dashboard');
    }

    public function backofficeRegister()
    {
        return view('auth.backoffice-admin.register-admin');
    }

    public function backofficeLogin()
    {
        return view('auth.backoffice-admin.login-admin');
    }
}
