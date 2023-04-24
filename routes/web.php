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
Route::get('/filtres', [Controller::class, 'filtresMeubles'])->name('meubles.filtres');


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::get('/compte', function () {
    return view('Compte');
})->middleware(['auth'])->name('compte');

//Route::get('/meubles/{categorie}', [MeublesParCategorieController::class, 'index'])->name('MeublesParCategorie');
//Route::get('/Meuble', function () {
//    return view('Compte');
//});

Route::get('/meubles/{id}',[Controller::class, 'getMeuble'])->name('voir.meuble');

/*! Admin */
Route::get('/admin',[admin\MeubleController::class,'index'])->middleware('admin')->name('indexAdmin');

Route::get('/admin/categorie',[admin\MeubleController::class,'viewCategorie'])->middleware('admin')->name('categorie');
Route::post('/admin/ajouter_categorie',[CategorieController::class,'ajouterCategorie'])->middleware('admin')->name('ajouter_categorie');

Route::get('/admin/categorie/{id}', [CategorieController::class, 'getCategorie'])->middleware('admin')->name('categorie.afficher');
Route::post('/admin/categorie/{id}', [CategorieController::class, 'modifierCategorie'])->middleware('admin')->name('categorie.modifier');
Route::delete('/admin/categorie/{id}', [CategorieController::class, 'supprimerCategorie'])->middleware('admin')->name('categorie.supprimer');


Route::get('/admin/couleur',[admin\MeubleController::class,'viewCouleur'])->middleware('admin')->name('couleur');
Route::post('/admin/ajouter_couleur',[CouleurController::class,'ajouterCouleur'])->middleware('admin')->name('ajouter_couleur');

Route::get('/admin/couleur/{id}', [CouleurController::class, 'getCouleur'])->middleware('admin')->name('couleur.afficher');
Route::put('/admin/couleur/{id}', [CouleurController::class, 'modifierCouleur'])->middleware('admin')->name('couleur.modifier');
Route::delete('/admin/couleur/{id}', [CouleurController::class, 'supprimerCouleur'])->middleware('admin')->name('couleur.supprimer');

Route::get('/admin/ajouter_meubles',[admin\MeubleController::class,'viewAjoutMeuble'])->middleware('admin')->name('ajouter_meubles');
Route::post('/admin/enregistrer_meuble',[admin\MeubleController::class,'enregistrer_meuble'])->middleware('admin')->name('enregistrer_meuble');

Route::get('/admin/meuble/{id}', [admin\MeubleController::class, 'getMeuble'])->middleware('admin')->name('meuble.afficher');
Route::post('/admin/meuble/{id}', [admin\MeubleController::class, 'modifierMeuble'])->middleware('admin')->name('meuble.modifier');
Route::delete('/admin/meuble/{id}', [admin\MeubleController::class, 'supprimerMeuble'])->middleware('admin')->name('meuble.supprimer');


//Route::get('/meubles/{categorie}', [MeublesParCategorieController::class, 'index'])->name('MeublesParCategorie');

/*! Compte */
Route::get('/moncompte/mesCommandes', [MesCommandes::class, 'index'])->name('mesCommandes');

Route::get('/moncompte/mesInformations', [MesInformations::class, 'index'])->name('mesInformations');
Route::post('/moncompte/mesInformations', [MesInformations::class, 'modifier'])->name('mesInformations.modifier');

Route::get('/moncompte/motdepasse', [MesInformations::class, 'index2'])->name('mesInformations.MotDePasse');
Route::post('/moncompte/motdepasse', [MesInformations::class, 'modifierMotDePasse'])->name('mesInformations.modifierMotDePasse');

Route::get('/moncompte/mescartesdepaiements', [MesCartesDePaiement::class, 'index'])->name('MesCartesDePaiement');

Route::post('/logout', function () { auth()->logout(); return redirect('/'); })->name('logout');

require __DIR__.'/auth.php';
