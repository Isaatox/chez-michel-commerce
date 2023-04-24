<?php

namespace App\Http\Controllers\mon_compte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MesCartesDePaiement extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('compte.mesCartesPaiement', compact('user'));
    }
}
