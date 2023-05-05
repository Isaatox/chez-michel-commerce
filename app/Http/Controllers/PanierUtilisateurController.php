<?php

namespace App\Http\Controllers;

use App\Models\AdresseLivraison;
use App\Models\CarteBancaire;
use App\Models\Commande;
use App\Models\Meuble;
use App\Models\PanierItem;
use App\Models\PanierUtilisateur;
use Dompdf\Dompdf;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Stripe\PaymentMethod;
use Stripe\Stripe;

class PanierUtilisateurController extends Controller
{
    public function voirPanier()
    {
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

            return view('panier.panierDetail', compact('meubles', 'panierItems', 'panier_id', 'countPanierItems'));
        } else {
            // aucun panier actif trouvé pour cet utilisateur
            return view('panier.panierDetail');
        }
    }

    public function voirPanierLivraison()
    {
        $user_id = auth()->id();
        $panierId = PanierUtilisateur::where('user_id', $user_id)
            ->where('actif', true)
            ->value('id');

        $countPanierItems = PanierItem::where('id_panier_utilisateur', $panierId)
            ->count();
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

            return view('panier.panierLivraison', compact('meubles', 'panierItems', 'adresseLivraison', 'countPanierItems'));
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

//        dump($commande);
        return redirect()->route('monPanier.paiement');
    }
    public function voirPanierPaiement()
    {
        $user_id = auth()->id();
        $panierId = PanierUtilisateur::where('user_id', $user_id)
            ->where('actif', true)
            ->value('id');

        $countPanierItems = PanierItem::where('id_panier_utilisateur', $panierId)
            ->count();
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

            $commande = Commande::where('pannier_commande', $panier->id)->first();
            $adresseLivraison = null;
            if ($commande) {
                $adresseLivraison = AdresseLivraison::find($commande->adresse_livraison);
            }

            $cartes = [];

            $default_payment_method = auth()->user()->default_payment_method;

            if ($default_payment_method) {
                try {
                    // Configurez la clé secrète de l'API Stripe
                    Stripe::setApiKey('sk_test_51N3dWDGHcD5THvo56jH6WSO54RMQkX5TKzp02g4lz0uIlZatSkw02T6yTfIjsMJCWg7FcZIAy4NAqVfV6JOnZP3O00dyopFRZD');

                    // Récupérez toutes les cartes de l'utilisateur
                    $all_pm = PaymentMethod::all([
                        'customer' => auth()->user()->stripe_id,
                        'type' => 'card'
                    ]);

                    // Bouclez sur les cartes et récupérez les informations pour chaque carte
                    foreach ($all_pm->data as $pm) {
                        $card_brand = strtolower($pm->card->brand);
                        $card_last4 = $pm->card->last4;
                        $card_exp_month = str_pad($pm->card->exp_month, 2, '0', STR_PAD_LEFT);
                        $card_exp_year = substr($pm->card->exp_year, -2);
                        $cartes[] = [
                            'ID' => $pm->id,
                            'brand' => $card_brand,
                            'last4' =>  $card_last4,
                            'exp_date' => $card_exp_month . '/' . $card_exp_year,
                            'logo' => $card_brand == 'visa' ? 'visa.png' : ($card_brand == 'mastercard' ? 'mastercard.png' : '')
                        ];
                    }
                } catch (\Exception $e) {
                    // Gérer les erreurs ici
                }
            }

            return view('panier.panierPaiement', compact('meubles', 'panierItems', 'adresseLivraison', 'cartes', 'countPanierItems'));
        } else {
            // aucun panier actif trouvé pour cet utilisateur
            return redirect()->route('monPanier.detail');
        }
    }

    public function validerCarte(Request $request)
    {
        // Récupérer les données du formulaire
        $nom_carte = $request->input('nom_carte');
        $numero_carte = $request->input('numero_carte');
        $date_expiration = $request->input('date_expiration');
        $cvc = $request->input('cvc');
        $carte_bancaire = $request->input('carte_bancaire');

        $date_livraison = Carbon::now()->addDays(rand(3, 5))->toDateString();

        // Vérifier si une nouvelle carte bancaire a été saisie
        if (empty($carte_bancaire)) {
            try {
                // Créer une nouvelle carte dans Stripe
                Stripe::setApiKey('sk_test_51N3dWDGHcD5THvo56jH6WSO54RMQkX5TKzp02g4lz0uIlZatSkw02T6yTfIjsMJCWg7FcZIAy4NAqVfV6JOnZP3O00dyopFRZD');
                $card = PaymentMethod::create([
                    'type' => 'card',
                    'card' => [
                        'number' => $numero_carte,
                        'exp_month' => substr($date_expiration, 0, 2),
                        'exp_year' => '20' . substr($date_expiration, 3, 2),
                        'cvc' => $cvc,
                    ],
                ]);
                // Enregistrer la nouvelle carte dans la base de données
                $nouvelle_carte = new CarteBancaire();
                $nouvelle_carte->id_user = auth()->user()->id;
                $nouvelle_carte->nom_carte = $nom_carte;
                $nouvelle_carte->card_id = $card->id;
                $nouvelle_carte->save();
                // Ajouter l'ID de la carte à la commande
                $commande = Commande::find(Auth::user()->commande_en_cours);
                $commande->card_id = $card->id;
                $commande->date_livraison = $date_livraison;
                $commande->actif = false;
                $commande->save();
            } catch (\Exception $e) {
                // Gérer les erreurs ici
            }
        } else {
            // Ajouter l'ID de la carte sélectionnée à la commande
            $commande = Commande::find(Auth::user()->commande_en_cours);
            $commande->card_id = $carte_bancaire;
            $commande->date_livraison = $date_livraison;
            $commande->actif = false;
            $commande->save();
        }

        $panier = PanierUtilisateur::with('panierItems')
            ->where('actif', 1)
            ->where('user_id', auth()->user()->id)
            ->first();

        $panierItems = $panier->panierItems;

        foreach ($panierItems as $panierItem) {
            $id_item = $panierItem->id_item;
            $quantite = $panierItem->quantite;

            // Retirer la quantité de l'élément dans la table des meubles
            $meuble = Meuble::find($id_item);
            $meuble->stock -= $quantite;
            $meuble->save();
        }

        $panier->actif = 0;
        $panier->save();
//        dump($panier);

        return redirect()->route('monPanier.recapitulatif');
    }

    public function voirPanierRecapitulatif()
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

        return view('panier.panierRecap', compact( 'adresseLivraison','panierItems', 'commande', 'meubles', 'countPanierItems'));
    }

    public function telechargerPdfRecapitulatif()
    {
        // Récupérer les données nécessaires depuis la méthode voirPanierRecapitulatif
        $user_id = auth()->id();
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
