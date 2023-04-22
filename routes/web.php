<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CouleurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mon_compte\MesCommandes;
use App\Http\Controllers\mon_compte\MesInformations;
use App\Http\Controllers\MeublesParCategorieController;
use App\Http\Controllers\mon_compte\MesCartesDePaiement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class, 'index'])->name('index');

/*! Mon petit Evan regarde les routes si dessoous mon bichon ps ( oublis pas les putain de route de déco et de mdp a changer ) : MON COMPTE */
Route::get('/mon_compte/MesCartesDePaiements', [MesCartesDePaiement::class, 'index'])->name('MesCartesDePaiement');
Route::get('/mon_compte/MesCommandes', [MesCommandes::class, 'index'])->name('MesCommandes');
Route::get('/mon_compte/MesInformations', [MesInformations::class, 'index'])->name('MesInformations');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/compte', function () {
    return view('Compte');
});

Route::get('/meubles/{categorie}', [MeublesParCategorieController::class, 'index'])->name('MeublesParCategorie');
Route::get('/Meuble', function () {
    return view('Compte');
});




/*! Admin */
Route::get('/admin',[admin\MeubleController::class,'index'])->name('index');

Route::get('/admin/categorie',[admin\MeubleController::class,'viewCategorie'])->name('categorie');
Route::post('/admin/ajouter_categorie',[CategorieController::class,'ajouterCategorie'])->name('ajouter_categorie');

Route::get('/admin/categorie/{id}', [CategorieController::class, 'getCategorie'])->name('categorie.afficher');
Route::post('/admin/categorie/{id}', [CategorieController::class, 'modifierCategorie'])->name('categorie.modifier');
Route::delete('/admin/categorie/{id}', [CategorieController::class, 'supprimerCategorie'])->name('categorie.supprimer');


Route::get('/admin/couleur',[admin\MeubleController::class,'viewCouleur'])->name('couleur');
Route::post('/admin/ajouter_couleur',[CouleurController::class,'ajouterCouleur'])->name('ajouter_couleur');

Route::get('/admin/couleur/{id}', [CouleurController::class, 'getCouleur'])->name('couleur.afficher');
Route::put('/admin/couleur/{id}', [CouleurController::class, 'modifierCouleur'])->name('couleur.modifier');
Route::delete('/admin/couleur/{id}', [CouleurController::class, 'supprimerCouleur'])->name('couleur.supprimer');

Route::get('/admin/ajouter_meubles',[admin\MeubleController::class,'viewAjoutMeuble'])->name('ajouter_meubles');
Route::post('/admin/enregistrer_meuble',[admin\MeubleController::class,'enregistrer_meuble'])->name('enregistrer_meuble');

Route::get('/admin/meuble/{id}', [admin\MeubleController::class, 'getMeuble'])->name('meuble.afficher');
Route::post('/admin/meuble/{id}', [admin\MeubleController::class, 'modifierMeuble'])->name('meuble.modifier');
Route::delete('/admin/meuble/{id}', [admin\MeubleController::class, 'supprimerMeuble'])->name('meuble.supprimer');



require __DIR__.'/auth.php';
