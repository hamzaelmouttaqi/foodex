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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('clients', 'App\Http\Controllers\ClientController');
Route::resource('alimentaire', 'App\Http\Controllers\AlimentaireController');
Route::resource('categorie', 'App\Http\Controllers\CategorieController');
Route::resource('composants', 'App\Http\Controllers\ComposantsController');
Route::resource('Category', 'App\Http\Controllers\CategoryComposantController');
Route::resource('Avis', 'App\Http\Controllers\AvisController');
Route::resource('supplement', 'App\Http\Controllers\SupplementController');
Route::get('/changeStatus', [App\Http\Controllers\SupplementController::class, 'changeStatus'])->name('supplement.changeStatut');
