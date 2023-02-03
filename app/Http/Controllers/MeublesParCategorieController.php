<?php

namespace App\Http\Controllers;

use App\Models\Meuble;
use Illuminate\Http\Request;

class MeublesParCategorieController extends Controller
{
    public function index(string $categorie)
    {
        $meubles = Meuble::where('categorie', $categorie)->get();
        return view('categorie', [
            'meubles' => $meubles,
        ]);
    }
}
