<?php

namespace App\Http\Controllers\mon_compte;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MesCommandes extends Controller
{
    public function index()
    {
        $commandes = Commande::where('utilisateur_commande', Auth::user()->id)->get();
        return view('mon_compte.mes_cartes_de_paiement', [
            'commandes' => $commandes,
        ]);
    }
}
