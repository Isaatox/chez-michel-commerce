<?php

namespace App\Http\Controllers\mon_compte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MesCartesDePaiement extends Controller
{
    public function index()
    {
        $cartes = CarteBancaire::where('id_user', \Auth::user()->id)->get();
        return view('mon_compte.mes_cartes_de_paiement', [
            'cartes' => $cartes
        ]);
    }
}
