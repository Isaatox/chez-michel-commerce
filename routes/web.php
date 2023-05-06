<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\AvisMeublesController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CouleurController;
use App\Http\Controllers\PanierItemController;
use App\Http\Controllers\PanierUtilisateurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mon_compte\MesCommandes;
use App\Http\Controllers\mon_compte\MesInformations;
use App\Http\Controllers\MeublesParCategorieController;
use App\Http\Controllers\mon_compte\MesCartesDePaiement;
use App\Http\Controllers\admin\UtilisateurController;

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

//Route::get('/compte', function () {
//    return view('Compte');
//})->middleware(['auth'])->name('compte');

//Route::get('/meubles/{categorie}', [MeublesParCategorieController::class, 'index'])->name('MeublesParCategorie');
//Route::get('/Meuble', function () {
//    return view('Compte');
//});

Route::get('/meubles/{id}',[Controller::class, 'getMeuble'])->name('voir.meuble');
Route::post('/meubles/ajouterAvis', [AvisMeublesController::class, 'ajouterAvis'])->name('avis-meuble.ajouterAvis');
Route::post('/meuble/{id}/ajouter-au-panier', [PanierItemController::class, 'ajouterAuPanier'])->middleware(['auth'])->name('meuble.ajouter-au-panier');

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

Route::get('/admin/utilisateur',[admin\UtilisateurController::class,'viewUtilisateur'])->middleware('admin')->name('utilisateur');

Route::get('/admin/utilisateur/{id}',[UtilisateurController::class,'getUtilisateur'])->middleware('admin')->name('utilisateur.afficher');
Route::post('/admin/utilisateur/{id}', [UtilisateurController::class, 'modifierUtilisateur'])->middleware('admin')->name('utilisateur.modifier');
Route::delete('/admin/utilisateur/{id}', [UtilisateurController::class, 'supprimerUtilisteur'])->middleware('admin')->name('utilisateur.delete');


//Route::get('/meubles/{categorie}', [MeublesParCategorieController::class, 'index'])->name('MeublesParCategorie');

/*! Compte */
Route::get('/moncompte/mesinformations', [MesInformations::class, 'getinformation'])->middleware(['auth'])->name('mesInformations');
Route::post('/moncompte/mesinformations', [MesInformations::class, 'informationmodifier'])->middleware(['auth'])->name('mesinformations.modifier');

Route::get('/moncompte/motdepasse', [MesInformations::class, 'getmotdepasse'])->middleware(['auth'])->name('motedepasse');
Route::post('/moncompte/motdepasse', [MesInformations::class, 'modifiermotdepasse'])->middleware(['auth'])->name('motdepasse.modifier');

Route::get('/moncompte/mescartesdepaiements/', [MesCartesDePaiement::class, 'getcartepaiementall'])->middleware(['auth'])->name('cartepaiement');

Route::post('/moncompte/mescartesdepaiements/', [MesCartesDePaiement::class, 'ajouterCarte'])->middleware(['auth'])->name('ajouter.carte');

Route::get('/moncompte/mesCommandes', [MesCommandes::class, 'getCommande'])->middleware(['auth'])->name('mescommandes');

//Panier
Route::get('/monPanier', [PanierUtilisateurController::class, 'voirPanier'])->middleware(['auth'])->name('monPanier.detail');
Route::post('/monPanier/modifierQuantite', [PanierUtilisateurController::class, 'modifierQuantite'])->middleware(['auth'])->name('panier.modifierQuantite');
Route::get('/monPanier/livraison', [PanierUtilisateurController::class, 'voirPanierLivraison'])->middleware(['auth'])->name('monPanier.livraison');
Route::post('/monPanier/livraison', [PanierUtilisateurController::class, 'validerAdresse'])->middleware(['auth'])->name('adresseLivraison.store');
Route::get('/monPanier/paiement', [PanierUtilisateurController::class, 'voirPanierPaiement'])->middleware(['auth'])->name('monPanier.paiement');
Route::post('/monPanier/paiement', [PanierUtilisateurController::class, 'validerCarte'])->middleware(['auth'])->name('paiement.store');
Route::get('/monPanier/recapitulatif', [PanierUtilisateurController::class, 'voirPanierRecapitulatif'])->middleware(['auth'])->name('monPanier.recapitulatif');
Route::get('/monPanier/recapitulatif/telecharger', [PanierUtilisateurController::class, 'telechargerPdfRecapitulatif'])->middleware(['auth'])->name('monPanier.pdf');


//Commande
Route::post('/creer_commande', [CommandeController::class, 'creerCommande'])->middleware('auth')->name('commande.creer');

//Route::post('/moncompte/mescartesdepaiements', [MesCartesDePaiement::class, 'modifierCarte'])
//    ->middleware(['auth'])
//    ->name('cartepaiement.modifier');

Route::post('/logout', function () { auth()->logout(); return redirect('/'); })->name('logout');

require __DIR__.'/auth.php';
