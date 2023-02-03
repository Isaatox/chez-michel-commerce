<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeubleController extends Controller
{
    public function index()
    {
        return view('admin.ajouter_meuble');
    }
    
    public function enregistrer_meuble(Request $request)
    {        
        if (!isset($request->image1)) {
            $request->validate([
                'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $fileName = $request->nom . time() . '.' . request()->image1->getClientOriginalExtension();
            $request->image1->storeAs('image1', $fileName);
        }

        if (!isset($request->image2)) {
            $request->validate([
                'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $fileName = $request->nom . time() . '.' . request()->image2->getClientOriginalExtension();
            $request->image2->storeAs('image2', $fileName);
        }

        if (!isset($request->image3)) {
            $request->validate([
                'image3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $fileName = $request->nom . time() . '.' . request()->image3->getClientOriginalExtension();
            $request->image3->storeAs('image3', $fileName);
        }

        $meuble = Meuble::create([
            'nom' => $request->nom,
            'categorie' => $request->categorie,
            'couleur' => $request->couleur,
            'description' => $request->description,
            'stock' => $request->stock,
            'prix' => $request->prix,
            'photo1' => $request->image1,
        ]);
        return redirect("ajouter_meuble");
    }
}
