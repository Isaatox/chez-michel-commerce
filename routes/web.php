<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeubleController;

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

Route::get('/ajouter_meuble', function () {
    return view('ajouter_meuble');
});

Route::post('/enregistrer_meuble',[MeubleController::class,'enregistrer_meuble'])->name('enregistrer_meuble');

require __DIR__.'/auth.php';
