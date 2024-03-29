<?php

namespace App\Http\Controllers;

use App\Models\Couleur;
use App\Models\Categorie;
use App\Models\Meuble;
use App\Models\PanierItem;
use App\Models\PanierUtilisateur;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
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

        $meubles = Meuble::take(4)->get();
        $categories = Categorie::all();
        $couleurs = Couleur::all();
        return view('index', [
            'categories' => $categories,
            'couleurs' => $couleurs,
            'meubles' => $meubles,
            'countPanierItems' => $countPanierItems,
        ]);
    }

    public function getMeuble($id)
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

        $categories = Categorie::all();
        $couleurs = Couleur::all();
        $meuble = Meuble::with(['avis' => function ($query) {
            $query->with('utilisateur')->latest();
        }])->findOrFail($id);
        return view('Meuble', compact('meuble', 'couleurs', 'categories', 'countPanierItems'));
    }

    public function filtresMeubles()
    {
        $categories = Categorie::all();
        $couleurs = Couleur::all();
        $meubles = Meuble::query()->with('avis');

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
                    $meubles->leftJoin('avis_meubles', 'meubles.id', '=', 'avis_meubles.id_meuble')
                        ->selectRaw('meubles.*, AVG(avis_meubles.note) as moyenne_notes')
                        ->groupBy('meubles.id')
                        ->orderBy('moyenne_notes', 'desc');
                    break;
                default:
                    break;
            }
        }
        //$query = $meubles->toSql(); // obtenir la requête SQL
        //dump($query);
        $meubles = $meubles->get();

        return view('index', compact('meubles', 'couleurs', 'categories'));
    }
}
