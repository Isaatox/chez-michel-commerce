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

    public function filtresMeubles()
    {
        $categories = Categorie::all();
        $couleurs = Couleur::all();
        $meubles = Meuble::query();

        if (request()->has('couleur')) {
            $couleursID = request()->couleur;
            $meubles->whereIn('couleur_id', $couleursID);
        }


        if (request()->has('min_prix') && request()->has('max_prix')) {
            $min_prix = request()->min_prix;
            $max_prix = request()->max_prix;
            $meubles->whereBetween('prix', [$min_prix, $max_prix]);
        }

        if (request()->has('categorie')) {
            $categorie = request()->categorie;
            $meubles->whereIn('categorie', $categorie);
        }

        if (request()->has('ordre')) {
            $ordre = request()->ordre;
            switch ($ordre) {
                case 'prixCroissant':
                    $meubles->orderBy('prix', 'asc');
                    break;
                case 'prixDecroissant':
                    $meubles->orderBy('prix', 'desc');
                    break;
                case 'nom':
                    $meubles->orderBy('nom', 'asc');
                    break;
                case 'noteClient':
                    $meubles->orderBy('note_client', 'desc');
                    break;
                default:
                    break;
            }
        }
        $query = $meubles->toSql(); // obtenir la requête SQL
dump($query);
        $meubles = $meubles->get();

        return view('index', compact('meubles', 'couleurs', 'categories'));
    }
}
