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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::get('/meubles/{categorie}', [MeublesParCategorieController::class, 'index'])->name('MeublesParCategorie');

/*! Compte */
Route::get('/MonCompte/MesCommandes', [MesCommandes::class, 'index'])->name('MesCommandes');
Route::get('/MonCompte/MesInformations', [MesInformations::class, 'index'])->name('MesInformations');
Route::get('/MonCompte/MotDepasse', [MotDePasse::class, 'index'])->name('MotDePasse');
Route::get('/MonCompte/MesCartesDePaiements', [MesCartesDePaiement::class, 'index'])->name('MesCartesDePaiement');


/*! Admin */
Route::get('/admin',[admin\MeubleController::class,'index'])->name('ajouter_meubles');
Route::post('/admin/enregistrer_meuble',[admin\MeubleController::class,'enregistrer_meuble'])->name('enregistrer_meuble');

require __DIR__.'/auth.php';
