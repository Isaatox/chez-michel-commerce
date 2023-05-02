<?php

namespace App\Http\Controllers\mon_compte;

use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarteBancaire;
use App\Models\User;

class MesCartesDePaiement extends Controller
{
    public function getcartepaiementall()
    {
//        $creditCard = CarteBancaire::all();
        return view('compte.mesCartesPaiement');
    }

    public function getcartepaiement($id)
    {
        $user = User::findOrFail($id);
        $creditCard = CarteBancaire::where('id_user', $user->id)->first();
        return view('compte.mesCartesPaiement', ['user' => $user, 'creditCard' => $creditCard]);
    }

    public function modifierCarte(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $creditCard = CarteBancaire::where('id_user', $user->id)->first();

        $validator = Validator::make($request->all(), [
            'nom' => ['required', 'string', 'max:255'],
            'numero_carte' => ['required', 'string', 'size:16'],
            'date_validite' => ['required', 'date_format:m/Y'],
            'cryptogramme' => ['required', 'string', 'size:3'],
            'type' => ['required', 'string', 'size:3']
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $creditCard->nom = $request->input('nom');
        $creditCard->numero_carte = encrypt($request->input('numero_carte'));
        $creditCard->date_validite = $request->input('date_validite');
        $creditCard->cryptogramme = encrypt($request->input('cryptogramme'));
        $creditCard->type = $request->input('type');

        $creditCard->save();

        return redirect()->back()->with('success', 'Carte bancaire mise à jour avec succès.');
    }
}
