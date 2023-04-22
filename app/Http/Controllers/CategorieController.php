<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function ajouterCategorie(Request $request)
    {

        Categorie::create([
            'nom' => $request->nom,
            'label' => $request->label,
        ]);

        return redirect("admin/categorie");

    }
}
