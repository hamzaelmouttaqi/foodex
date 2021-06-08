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
Route::resource('livraison', 'App\Http\Controllers\LivraisonController');
Route::get('/changeStatusLivreur', [App\Http\Controllers\LivreurController::class, 'changeStatusLivreur'])->name('livreur.changeStatusLivreur');
Route::get('/changeStatus', [App\Http\Controllers\SupplementController::class, 'changeStatus'])->name('supplement.changeStatus');
Route::resource('commande', 'App\Http\Controllers\CommandeController');
Route::get('/changeStatut', [App\Http\Controllers\CommandeController::class, 'changeStatut'])->name('commande.changeStatut');
Route::get('/supprimer', [App\Http\Controllers\CommandeController::class, 'supprimer'])->name('commande.supprimer');
Route::post('/insert', [App\Http\Controllers\CommandeController::class, 'insert'])->name('commande.insert');
Route::get('/complete',[App\Http\Controllers\CommandeController::class, 'complete'])->name('complete');
Route::get('/non-complete',[App\Http\Controllers\CommandeController::class, 'noncomplete'])->name('noncomplete');
Route::get('/catalogue',[App\Http\Controllers\AlimentaireController::class, 'catalogue'])->name('alimentaire.catalogue');
Route::resource('parametre', 'App\Http\Controllers\ParametreController');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

