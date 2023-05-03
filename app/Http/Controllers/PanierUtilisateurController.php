<?php

namespace App\Http\Controllers;

use App\Models\AdresseLivraison;
use App\Models\Commande;
use App\Models\Meuble;
use App\Models\PanierItem;
use App\Models\PanierUtilisateur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PanierUtilisateurController extends Controller
{
    public function voirPanier()
    {
        $user_id = auth()->id();

        $panier = PanierUtilisateur::where('user_id', $user_id)
            ->where('actif', 1)
            ->first();

        if ($panier) {
            $panierItems = PanierItem::where('id_panier_utilisateur', $panier->id)->get();

            $meubles = array();
            foreach ($panierItems as $item) {
                $meuble = Meuble::find($item->id_item);
                $meubles[] = $meuble;

            }
            $panier_id = $panier->id; // Récupération de l'id du panier actif

            return view('panier.panierDetail', compact('meubles', 'panierItems', 'panier_id'));
        } else {
            // aucun panier actif trouvé pour cet utilisateur
            return view('panier.panierDetail');
        }
    }

    public function voirPanierLivraison()
    {
        $user_id = auth()->id();

        $panier = PanierUtilisateur::where('user_id', $user_id)
            ->where('actif', 1)
            ->first();

        if ($panier) {
            $panierItems = PanierItem::where('id_panier_utilisateur', $panier->id)->get();

            $meubles = array();
            foreach ($panierItems as $item) {
                $meuble = Meuble::find($item->id_item);
                $meubles[] = $meuble;

            }

            $adresseLivraison = AdresseLivraison::where('id_utilisateur', $user_id)->get();

            return view('panier.panierLivraison', compact('meubles', 'panierItems', 'adresseLivraison'));
        } else {
            // aucun panier actif trouvé pour cet utilisateur
            return view('panier.panierDetail');
        }
    }

    public function validerAdresse(Request $request) {
        $adresseId = $request->input('adresse_livraison');
        $adresse_livraison = null;


        if ($adresseId) {
            // Récupérer l'adresse existante à partir de l'ID
            $adresse_livraison = AdresseLivraison::find($adresseId);
        } else {
            // Vérifier les données du formulaire
            $validator = Validator::make($request->all(), [
                'nom' => 'required',
                'prenom' => 'required',
                'adresse' => 'required',
                'code_postal' => 'required',
                'ville' => 'required',
                'pays' => 'required',
                'id_utilisateur' => 'required'
            ]);

            if ($validator->fails()) {
                // Les données du formulaire ne sont pas valides, afficher des messages d'erreur
                return back()->withErrors($validator);
            } else {
                // Créer une nouvelle adresse et récupérer l'ID
                $adresseLivraison = new AdresseLivraison;
                $adresseLivraison->nom = $request->input('nom');
                $adresseLivraison->prenom = $request->input('prenom');
                $adresseLivraison->rue = $request->input('adresse');
                $adresseLivraison->code_postal = $request->input('code_postal');
                $adresseLivraison->ville = $request->input('ville');
                $adresseLivraison->pays = $request->input('pays');
                $adresseLivraison->id_utilisateur = $request->input('id_utilisateur');
                $adresseLivraison->save();
                $adresseId = $adresseLivraison->id;
            }
        }
        // Mettre à jour la commande avec l'adresse sélectionnée ou créée
        $commande = Commande::find(Auth::user()->commande_en_cours);
        $commande->adresse_livraison = $adresseId;
        $commande->save();

        return redirect('/monPanier/paiement');
    }
    public function voirPanierPaiement()
    {
        return view('panier.panierPaiement');
    }

    public function voirPanierRecapitulatif()
    {
        return view('panier.panierRecap');
    }
}
