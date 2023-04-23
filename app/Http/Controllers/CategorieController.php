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

    public function supprimerCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect("admin/categorie");
    }

    public function modifierCategorie(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->nom = $request->nom;
        $categorie->label = $request->label;
        $categorie->save();
        return redirect("admin/categorie");
    }

    public function getCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categorieDetail', ['categorie' => $categorie]);
    }
}
