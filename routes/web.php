<?php

use App\Http\Controllers\admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeublesParCategorieController;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/Compte', function () {
    return view('Compte');
});

Route::get('/meubles/{categorie}', [MeublesParCategorieController::class, 'index'])->name('MeublesParCategorie');



/*! Admin */
Route::get('/admin/ajouter_meubles',[admin\MeubleController::class,'index'])->name('ajouter_meubles');
Route::post('/admin/enregistrer_meuble',[admin\MeubleController::class,'enregistrer_meuble'])->name('enregistrer_meuble');

require __DIR__.'/auth.php';
