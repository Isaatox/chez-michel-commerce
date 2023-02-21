<?php

namespace App\Http\Controllers;

use App\Models\Couleur;
use App\Models\Categorie;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $categories = Categorie::all();
        $couleurs = Couleur::all();
        return view('index', [
            'categories' => $categories,
            'couleurs' => $couleurs
        ]);
    }
}
