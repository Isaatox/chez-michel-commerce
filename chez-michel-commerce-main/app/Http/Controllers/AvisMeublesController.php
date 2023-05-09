<?php

namespace App\Http\Controllers;

use App\Models\AvisMeubles;
use Illuminate\Http\Request;

class AvisMeublesController extends Controller
{
    public function ajouterAvis(Request $request)
    {
        $avis = new AvisMeubles;

        $avis->id_utilisateur = auth()->id(); // récupère l'ID de l'utilisateur connecté
        $avis->id_meuble = $request->input('id_meuble');
        $avis->note = $request->input('rating');
        $avis->commentaire = $request->input('commentaire');

        $avis->save();

        return redirect()->back()->with('success', 'Votre avis a bien été ajouté.');
    }
}
