<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Couleur;
use App\Models\Meuble;
use Illuminate\Http\Request;

class MeubleController extends Controller
{
//    public function index()
//    {
//        return parent::index(); // TODO: Change the autogenerated stub
//        return view('')
//    }

    public function index()
    {
        return view('admin.admin');
    }

    public function viewAjoutMeuble(Request $request)
    {
        $categories = Categorie::all();
        $couleurs = Couleur::all();
        $meubles = Meuble::all();
        $sortOrder = 'asc'; // Valeur par défaut
        if(request()->has('sort_order')){
            $sortOrder = request()->query('sort_order');
        }

        $meubles = Meuble::orderBy('nom', $sortOrder)->paginate(5);


        return view('admin.meuble', compact('meubles', 'sortOrder', 'categories', 'couleurs'));

    }

    public function enregistrer_meuble(Request $request)
    {
        $images = array();
        foreach($request->file('images') as $image) {
            $fileName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('public'), $fileName); // utilise public_path() pour sauvegarder les images dans le dossier public
            array_push($images, $fileName);
        }

       Meuble::create([
            'nom' => $request->nom,
            'categorie' => $request->categorie,
            'couleur' => $request->couleur,
            'description' => $request->description,
            'stock' => $request->stock,
            'prix' => $request->prix,
            'photo1' => $images[0],
            'photo2' => isset($images[1]) ? $images[1] : null,
            'photo3' => isset($images[2]) ? $images[2] : null,
        ]);

        return redirect("admin/ajouter_meubles");

    }

    public function getMeuble($id)
    {
        $categories = Categorie::all();
        $couleurs = Couleur::all();
        $meuble = Meuble::findOrFail($id);
        return view('admin.meubleDetail', compact('meuble','couleurs','categories'));
    }

    public function modifierMeuble(Request $request, $id)
    {
        $meuble = Meuble::findOrFail($id);

        // Supprime les anciennes images
        if ($meuble->photo1) {
            unlink(public_path('public/' . $meuble->photo1));
        }
        if ($meuble->photo2) {
            unlink(public_path('public/' . $meuble->photo2));
        }
        if ($meuble->photo3) {
            unlink(public_path('public/' . $meuble->photo3));
        }

        $images = array();
        foreach($request->file('images') as $image) {
            $fileName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('public'), $fileName);
            array_push($images, $fileName);
        }

        $meuble->nom = $request->nom;
        $meuble->categorie = $request->categorie;
        $meuble->couleur = $request->couleur;
        $meuble->description = $request->description;
        $meuble->stock = $request->stock;
        $meuble->prix = $request->prix;
        $meuble->photo1 = $images[0];
        $meuble->photo2 = isset($images[1]) ? $images[1] : null;
        $meuble->photo3 = isset($images[2]) ? $images[2] : null;
        $meuble->save();

        return redirect()->route('meuble.afficher', ['id' => $meuble->id])->with('success', 'Le meuble a été modifié avec succès.');
    }


    public function supprimerMeuble($id)
    {
        $meuble = Meuble::findOrFail($id);
        $meuble->delete();

        return redirect()->route('admin.liste_meubles')->with('success', 'Le meuble a été supprimé avec succès.');
    }


    public function viewCategorie()
    {
        $categories = Categorie::all();
        $categories = Categorie::orderBy('label', 'asc')->paginate(5);

        return view('admin.categorie', compact( 'categories'));
    }

    public function viewCouleur()
    {
        $couleurs = Couleur::all();
        $couleurs = Couleur::orderBy('label', 'asc')->paginate(5);
        return view('admin.couleur', compact( 'couleurs'));
    }
}
