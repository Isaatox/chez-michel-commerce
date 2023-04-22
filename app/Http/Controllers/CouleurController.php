<?php

namespace App\Http\Controllers;

use App\Models\Couleur;
use Illuminate\Http\Request;

class CouleurController extends Controller
{
    public function ajouterCouleur(Request $request)
    {

        Couleur::create([
            'nom' => $request->nom,
            'label' => $request->label,
            'hex_couleur' => $request->color,
        ]);

        return redirect("admin/couleur");
    }

    public function supprimerCouleur($id)
    {
        $couleur = Couleur::findOrFail($id);
        $couleur->delete();
        return redirect("admin/couleur");
    }

    public function modifierCouleur(Request $request, $id)
    {
        $couleur = Couleur::findOrFail($id);
        $couleur->nom = $request->nom;
        $couleur->label = $request->label;
        $couleur->hex_couleur = $request->color;
        $couleur->save();
        return redirect("admin/couleur");
    }

    public function getCouleur($id)
    {
        $couleur = Couleur::findOrFail($id);
        return view('admin.couleurDetail', ['couleur' => $couleur]);
    }

}
