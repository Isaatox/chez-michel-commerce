<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
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
Route::get('/admin',[admin\MeubleController::class,'index'])->name('ajouter_meubles');
Route::post('/admin/enregistrer_meuble',[admin\MeubleController::class,'enregistrer_meuble'])->name('enregistrer_meuble');

require __DIR__.'/auth.php';
