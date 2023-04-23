<?php

namespace App\Http\Controllers\mon_compte;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MesCommandes extends Controller
{
    public function index()
    {
        $commande = Mescommandes::where('id_user', \Auth::user()->id)->get();
        return view('compte.mesCommandes', [
            'commandes' => $commande
        ]);
    }
    
}
