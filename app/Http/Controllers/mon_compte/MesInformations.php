<?php

namespace App\Http\Controllers\mon_compte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MesInformations extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('compte.mesInformations', compact('user'));
    }

    public function modifier(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'civilite' => 'required|in:M,Mme',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
        ]);

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->civilite = $request->civilite;
        $user->adresse = $request->adresse;
        $user->ville = $request->ville;
        $user->code_postal = $request->code_postal;

        $user->save();

        return redirect()->route('compte.mesInformations')->with('success', 'Vos informations ont été mises à jour avec succès.');
    }
}