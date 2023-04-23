<?php

namespace App\Http\Controllers\mon_compte;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MesCommandes extends Controller
{
      public function index()
    {
        // Récupérer l'utilisateur courant
        $user = auth()->user();

        // Récupérer les commandes de l'utilisateur courant
        $commandes = $user->commandes;

        // Récupérer les données nécessaires pour chaque commande
        $commandesDetails = [];
        foreach ($commandes as $commande) {
            $commandeDetails = [
                'numero' => $commande->id,
                'prix' => $commande->prix,
                'statut' => $commande->statut,
                'nom' => $commande->nom,
                'adresse' => $commande->adresse,
                'ville' => $commande->ville,
            ];
            array_push($commandesDetails, $commandeDetails);
        }

        return view('commandes', [
            'commandesDetails' => $commandesDetails
        ]);
    }
}
