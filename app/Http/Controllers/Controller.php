<?php

namespace App\Http\Controllers;

use App\Models\Couleur;
use App\Models\Categorie;
use App\Models\Meuble;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $meubles = Meuble::take(4)->get();
        $categories = Categorie::all();
        $couleurs = Couleur::all();
        return view('index', [
            'categories' => $categories,
            'couleurs' => $couleurs,
            'meubles' => $meubles,
        ]);
    }

    public function getMeuble($id)
    {
        $categories = Categorie::all();
        $couleurs = Couleur::all();
        $meuble = Meuble::findOrFail($id);
        return view('Meuble', compact('meuble','couleurs','categories'));
    }
}
