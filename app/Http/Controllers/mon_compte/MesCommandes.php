<?php

namespace App\Http\Controllers\mon_compte;

use App\Models\Commande;
use App\Models\PanierItem;
use App\Models\PanierUtilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdresseLivraison;
use App\Models\CarteBancaire;
use App\Models\Meuble;
use Dompdf\Dompdf;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stripe\PaymentMethod;
use Stripe\Stripe;


class MesCommandes extends Controller
{
      public function getCommande()
    {
        $user_id = auth()->id();
        $panierId = PanierUtilisateur::where('user_id', $user_id)
            ->where('actif', true)
            ->value('id');

        $countPanierItems = PanierItem::where('id_panier_utilisateur', $panierId)
            ->count();
        $panier = PanierUtilisateur::where('user_id', $user_id)
            ->latest('updated_at')
            ->first();

        $commande = Commande::where('utilisateur_commande', $user_id)
            ->where('pannier_commande', $panier->id)
            ->first();

        $panierItems = PanierItem::where('id_panier_utilisateur', $panier->id)->get();

        $meubles = array();
        foreach ($panierItems as $item) {
            $meuble = Meuble::find($item->id_item);
            $meubles[] = $meuble;
        }

        $adresseLivraison = null;
        if ($commande) {
            $adresseLivraison = AdresseLivraison::find($commande->adresse_livraison);
        }

        return view('compte.mesCommandes', compact( 'adresseLivraison','panierItems', 'commande', 'meubles', 'countPanierItems'));
    }
}
