<?php

namespace App\Http\Controllers\mon_compte;

use App\Models\PanierItem;
use App\Models\PanierUtilisateur;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarteBancaire;
use App\Models\User;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\Token;

class MesCartesDePaiement extends Controller
{
    public function getcartepaiementall()
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
//        $creditCard = CarteBancaire::all();
        return view('compte.mesCartesPaiement', [
            'countPanierItems' => $countPanierItems,
        ]);
    }

    public function ajouterCarte(Request $request)
    {
        $nom_carte = $request->input('nom_carte');
        $numero_carte = $request->input('numero_carte');
        $expiration = $request->input('date_expiration');
        $cvc = $request->input('cvc');

        $expiration_parts = explode('/', $expiration);
        $expiration_mois = intval($expiration_parts[0] ?? 0);
        $expiration_annee = intval(substr($expiration_parts[1] ?? '', -2));

        try {
            // Configurez la clé secrète de l'API Stripe
            Stripe::setApiKey('sk_test_51N3dWDGHcD5THvo56jH6WSO54RMQkX5TKzp02g4lz0uIlZatSkw02T6yTfIjsMJCWg7FcZIAy4NAqVfV6JOnZP3O00dyopFRZD');

            // Créez le token Stripe avec les informations de la carte
            $token = Token::create([
                'card' => [
                    'number' => $numero_carte,
                    'exp_month' => $expiration_mois,
                    'exp_year' => $expiration_annee,
                    'cvc' => $cvc,
                ],
            ]);

            // Créez le client Stripe et associez le token à son compte
            $customer = Customer::create([
                'name' => $nom_carte,
                'source' => $token,
            ]);

            // Ajoutez le token de carte au profil de l'utilisateur
            $user = auth()->user();
            $user->stripe_id = $customer->id;
            $user->default_payment_method = $customer->default_source;
            $user->save();

            return redirect()->back()->with('success', 'La carte a été ajoutée');
        } catch (\ErrorException $e) {
            return redirect()->back()->with('error', 'La carte n\'a pas été ajoutée Erreur :' . $e);
        }
    }

//    public function getcartepaiement($id)
//    {
//        $user = User::findOrFail($id);
//        $creditCard = CarteBancaire::where('id_user', $user->id)->first();
//        return view('compte.mesCartesPaiement', ['user' => $user, 'creditCard' => $creditCard]);
//    }

//    public function modifierCarte(Request $request, $id)
//    {
//        $user = User::findOrFail($id);
//        $creditCard = CarteBancaire::where('id_user', $user->id)->first();
//
//        $validator = Validator::make($request->all(), [
//            'nom' => ['required', 'string', 'max:255'],
//            'numero_carte' => ['required', 'string', 'size:16'],
//            'date_validite' => ['required', 'date_format:m/Y'],
//            'cryptogramme' => ['required', 'string', 'size:3'],
//            'type' => ['required', 'string', 'size:3']
//        ]);
//
//
//        if ($validator->fails()) {
//            return redirect()->back()->withErrors($validator);
//        }
//
//        $creditCard->nom = $request->input('nom');
//        $creditCard->numero_carte = encrypt($request->input('numero_carte'));
//        $creditCard->date_validite = $request->input('date_validite');
//        $creditCard->cryptogramme = encrypt($request->input('cryptogramme'));
//        $creditCard->type = $request->input('type');
//
//        $creditCard->save();
//
//        return redirect()->back()->with('success', 'Carte bancaire mise à jour avec succès.');
//    }
}
