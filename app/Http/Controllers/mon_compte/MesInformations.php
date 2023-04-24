<?php

namespace App\Http\Controllers\mon_compte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class MesInformations extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('compte.mesInformations', compact('user'));
    }

    public function modifier(Request $request)
    {
    $user = auth()->user(); // récupérer l'utilisateur actuellement connecté
    
    $user->nom = $request->input('nom');
    $user->prenom = $request->input('prenom');
    $user->email = $request->input('email');
    $user->civilite = $request->input('civilite');
    $user->adresse = $request->input('adresse');
    $user->ville = $request->input('ville');
    $user->code_postal = $request->input('code_postal');

    
    $user->save(); // enregistrer les modifications dans la base de données
    
    return redirect()->back()->with('Vos informations ont été mises à jour avec succès.');
    }

    public function index2()
    {
        $user = auth()->user();

        return view('compte.motDePasse', compact('user'));
    }

    public function modifiermotdepasse(Request $request)
    {
        $user = auth()->user();

        // Vérifier que l'ancien mot de passe correspond
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->withErrors(['Le mot de passe actuel est incorrect.']);
        }

        // Valider le nouveau mot de passe
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Changer le mot de passe de l'utilisateur
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->back()->with('success', 'Le mot de passe a été changé avec succès.');
    }

}