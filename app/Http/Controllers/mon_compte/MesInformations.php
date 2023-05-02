<?php

namespace App\Http\Controllers\mon_compte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class MesInformations extends Controller
{
    public function getinformation()
    {
        $user = auth()->user();

        return view('compte.mesInformations', compact('user'));
    }

    public function informationmodifier(Request $request)
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

    public function getmotdepasse()
    {
        $user = auth()->user();

        return view('compte.motDePasse', compact('user'));
    }

    public function modifiermotdepasse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ancien_mot_de_passe' => ['required', 'string'],
            'nouveau_mot_de_passe' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = Auth::user();
        $oldPassword = $request->input('ancien_mot_de_passe');
        $newPassword = $request->input('nouveau_mot_de_passe');

        if (!Hash::check($oldPassword, $user->password)) {
            return redirect()->back()->withErrors(['ancien_mot_de_passe' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return redirect()->with('success', 'Votre mot de passe a été modifié avec succès.');
    }

}
