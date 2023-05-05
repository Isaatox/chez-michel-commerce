<?php

namespace App\Http\Controllers\mon_compte;

use App\Models\Commande;
use App\Models\PanierItem;
use App\Models\PanierUtilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MesCommandes extends Controller
{
      public function index()
    {
        // Récupérer l'utilisateur courant
        $user = auth()->user();
        if (auth()->check()) {
            $user_id = auth()->id();

            $panierId = PanierUtilisateur::where('user_id', $user_id)
                ->where('actif', true)
                ->value('id');

            $countPanierItems = PanierItem::where('id_panier_utilisateur', $panierId)
                ->count();
        }else{
            $countPanierItems = null;
        }
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
            'commandesDetails' => $commandesDetails,
            'countPanierItems' => $countPanierItems,
        ]);
    }
}
