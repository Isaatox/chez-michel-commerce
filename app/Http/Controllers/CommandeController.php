<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommandeController extends Controller
{
    public function creerCommande(Request $request)
    {
        $numero_commande = Str::random(10); // Génère un numéro de commande aléatoire

        $commande = new Commande();
        $commande->numero_commande = $numero_commande;
        $commande->utilisateur_commande = $request->input('utilisateur_commande');
        $commande->pannier_commande = $request->input('panier_commande');
        $commande->actif = true;
        $commande->save();

        // Mettre à jour la colonne commande_en_cours de l'utilisateur
        $utilisateur = auth()->user();
        $utilisateur->commande_en_cours = $commande->id;
        $utilisateur->save();

        return redirect('/monPanier/livraison');
    }
}
