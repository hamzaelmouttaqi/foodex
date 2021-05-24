<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('clients', 'App\Http\Controllers\ClientController');
Route::resource('alimentaire', 'App\Http\Controllers\AlimentaireController');
Route::resource('categorie', 'App\Http\Controllers\CategorieController');
Route::resource('composants', 'App\Http\Controllers\ComposantsController');
Route::resource('Category', 'App\Http\Controllers\CategoryComposantController');
Route::resource('Avis', 'App\Http\Controllers\AvisController');
Route::resource('supplement', 'App\Http\Controllers\SupplementController');
Route::resource('livreur', 'App\Http\Controllers\LivreurController');
Route::get('/changeStatusLivreur', [App\Http\Controllers\LivreurController::class, 'changeStatusLivreur'])->name('livreur.changeStatusLivreur');
Route::get('/changeStatus', [App\Http\Controllers\SupplementController::class, 'changeStatus'])->name('supplement.changeStatus');
Route::resource('commande', 'App\Http\Controllers\CommandeController');
Route::get('/changeStatut', [App\Http\Controllers\CommandeController::class, 'changeStatut'])->name('supplement.changeStatut');
Route::get('/supprimer', [App\Http\Controllers\CommandeController::class, 'supprimer'])->name('commande.supprimer');
Route::post('/insert', [App\Http\Controllers\CommandeController::class, 'insert'])->name('commande.insert');
Route::get('/complete',[App\Http\Controllers\CommandeController::class, 'complete'])->name('complete');
Route::get('/non-complete',[App\Http\Controllers\CommandeController::class, 'noncomplete'])->name('noncomplete');