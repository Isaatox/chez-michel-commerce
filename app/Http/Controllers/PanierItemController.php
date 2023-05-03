<?php

namespace App\Http\Controllers;

use App\Models\Meuble;
use App\Models\PanierItem;
use App\Models\PanierUtilisateur;
use Illuminate\Http\Request;

class PanierItemController extends Controller
{
    public function ajouterAuPanier($id, Request $request)
    {
        $meuble = Meuble::findOrFail($id);

        // Vérifier si l'utilisateur a un panier actif
        $panier = PanierUtilisateur::where('actif', 1)
            ->where('user_id', auth()->user()->id)
            ->first();

        // Si l'utilisateur n'a pas de panier actif, en créer un
        if (!$panier) {
            $panier = new PanierUtilisateur();
            $panier->nom = 'Panier de ' . auth()->user()->prenom . ' ' . auth()->user()->nom;
            $panier->actif = 1;
            $panier->user_id = auth()->user()->id;
            $panier->save();
        }
        // Vérifier si le meuble est en stock
        if ($meuble->stock > 0) {
            // Vérifier si l'article existe déjà dans le panier
            $panierItem = PanierItem::where('id_item', $meuble->id)
                ->where('id_panier_utilisateur', $panier->id)
                ->first();

            // Si l'article existe déjà dans le panier, augmenter la quantité
            if ($panierItem) {
                $panierItem->quantite += $request->quantite;
                $panierItem->save();
            } else {
                // Sinon, créer un nouvel article dans le panier
                $panierItem = new PanierItem();
                $panierItem->id_item = $meuble->id;
                $panierItem->quantite = $request->quantite;
                $panierItem->id_panier_utilisateur = $panier->id;
                $panierItem->save();
            }
            return redirect()->route('voir.meuble', $id)->with('success', 'Le meuble a été ajouté au panier avec succès.');
        } else {
            return redirect()->route('voir.meuble', $id)->with('error', 'Le meuble est en rupture de stock.');
        }
    }
}
