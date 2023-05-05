<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\PanierItem;
use App\Models\PanierUtilisateur;
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

        $categorie = Categorie::findOrFail($id);
        return view('admin.categorieDetail', ['categorie' => $categorie, 'countPanierItems' => $countPanierItems]);
    }
}
