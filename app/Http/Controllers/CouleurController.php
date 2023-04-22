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
}
