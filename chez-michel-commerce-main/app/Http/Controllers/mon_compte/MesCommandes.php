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
use function GuzzleHttp\Promise\all;


class MesCommandes extends Controller
{
    public function getCommandes()
    {
        if (auth()->check()) {
            $user_id = auth()->id();

            $panierId = PanierUtilisateur::where('user_id', $user_id)
                ->where('actif', true)
                ->value('id');

            $countPanierItems = PanierItem::where('id_panier_utilisateur', $panierId)
                ->count();
        } else {
            $countPanierItems = null;
        }

        $commandes = Commande::where('utilisateur_commande', $user_id)
            ->get();

        return view('compte.mesCommandes', compact('countPanierItems', 'commandes'));
    }

    public function getOneCommande($id)
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
            ->where('pannier_commande', $id)
            ->first();

        $panierItems = PanierItem::where('id_panier_utilisateur', $id)->get();

        $meubles = array();
        foreach ($panierItems as $item) {
            $meuble = Meuble::find($item->id_item);
            $meubles[] = $meuble;
        }

        $adresseLivraison = null;
        if ($commande) {
            $adresseLivraison = AdresseLivraison::find($commande->adresse_livraison);
        }

        return view('compte.maCommande', compact( 'adresseLivraison','panierItems', 'commande', 'meubles', 'countPanierItems'));
    }

    public function getOneCommandePDF($id)
    {
        // Récupérer les données nécessaires depuis la méthode voirPanierRecapitulatif
        $user_id = auth()->id();
        $panier = PanierUtilisateur::where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $commande = Commande::where('utilisateur_commande', $user_id)
            ->where('pannier_commande', $id)
            ->first();
        $panierItems = PanierItem::where('id_panier_utilisateur', $id)->get();
        $meubles = array();
        foreach ($panierItems as $item) {
            $meuble = Meuble::find($item->id_item);
            $meubles[] = $meuble;
        }
        $adresseLivraison = null;
        if ($commande) {
            $adresseLivraison = AdresseLivraison::find($commande->adresse_livraison);
        }
        $total = 0;
        foreach ($meubles as $key => $meuble) {
            $prixTotal = $meuble->prix * $panierItems[$key]->quantite;
            $total += $prixTotal;
        }

        // Générer le PDF
        $html = view('panier.pdfRecap', compact('adresseLivraison', 'panierItems', 'commande', 'meubles', 'total'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Renvoyer le PDF en téléchargement
        $filename = 'recapitulatif-commande-'.$commande->numero_commande.'.pdf';
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }
}
