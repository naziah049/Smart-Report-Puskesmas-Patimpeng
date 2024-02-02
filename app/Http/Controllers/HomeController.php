<?php

namespace App\Http\Controllers;

use App\Models\DataKeluhan;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totOnline = DataKeluhan::where('is_online', 1)->count();
        $totOffline = DataKeluhan::where('is_online', NULL)->count();
        $totPasien = User::where('role', 'pasien')->count();
        return view('dashboard', compact('totOnline', 'totOffline', 'totPasien'));
    }
}
