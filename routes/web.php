<?php

use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
	$id=DB::table('users')->select('id_client')->where('id',Auth::id())->value('id_client');
    return view('font.front')->with('commandes',Commande::with('clients')->where('id_client',$id)->where('status',1)->get());
});

Route::post('/changeImage', [App\Http\Controllers\ProfileController::class, 'changeImage'])->name('profile.changeImage');
Route::resource('menu','App\Http\Controllers\Menu');
Route::get('client-profil/{id}',[App\Http\Controllers\ProfileController::class, 'profil_client'])->name('profile.client');
Route::get('/facture_pdf/{id}',[App\Http\Controllers\CommandeController::class, 'facture_pdf'])->name('facture');
Route::get('/facture_client/{id}',[App\Http\Controllers\ClientController::class, 'facture_client'])->name('facture_client');


Route::group(['middleware' => ['auth','role:administrator,employee']], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('clients', 'App\Http\Controllers\ClientController');
Route::resource('alimentaire', 'App\Http\Controllers\AlimentaireController');
Route::resource('categorie', 'App\Http\Controllers\CategorieController');
Route::resource('livreur', 'App\Http\Controllers\LivreurController');
Route::resource('livraison', 'App\Http\Controllers\LivraisonController');
Route::resource('commande', 'App\Http\Controllers\CommandeController');
// Route::get('/commande/{commande}/edit', [App\Http\Controllers\CommandeController::class, 'edit'])->name('commande.edit');
// Route::get('/commande/{commande}', [App\Http\Controllers\CommandeController::class, 'show'])->name('commande.show');
// Route::delete('/commande/{commande}/destroy', [App\Http\Controllers\CommandeController::class, 'destroy'])->name('commande.destroy');
Route::get('/changeStatusLivreur', [App\Http\Controllers\LivreurController::class, 'changeStatusLivreur'])->name('livreur.changeStatusLivreur');
Route::get('/changeStatus', [App\Http\Controllers\SupplementController::class, 'changeStatus'])->name('supplement.changeStatus');
Route::get('/changeStatut', [App\Http\Controllers\CommandeController::class, 'changeStatut'])->name('commande.changeStatut');
Route::get('/supprimer', [App\Http\Controllers\CommandeController::class, 'supprimer'])->name('commande.supprimer');
Route::post('/insertCommande', [App\Http\Controllers\CommandeController::class, 'insert'])->name('commande.insert');
Route::post('/insert', [App\Http\Controllers\FournisseurController::class, 'insert'])->name('fournisseur.insert');
Route::get('/complete',[App\Http\Controllers\CommandeController::class, 'complete'])->name('complete');
Route::get('/non-complete',[App\Http\Controllers\CommandeController::class, 'noncomplete'])->name('noncomplete');
Route::get('/catalogue',[App\Http\Controllers\AlimentaireController::class, 'catalogue'])->name('alimentaire.catalogue');
Route::get('/changeStatuss', [App\Http\Controllers\CategorieController::class, 'changeStatuss'])->name('categorie.changeStatuss');
});

Route::group(['middleware' => ['auth','role:administrator']], function () {
	Route::resource('composants', 'App\Http\Controllers\ComposantsController');
	Route::resource('Category', 'App\Http\Controllers\CategoryComposantController');
	Route::resource('Avis', 'App\Http\Controllers\AvisController');
	Route::resource('supplement', 'App\Http\Controllers\SupplementController');
	Route::resource('produit', 'App\Http\Controllers\ProduitController');
	Route::resource('fournisseur', 'App\Http\Controllers\FournisseurController');
	Route::resource('achat', 'App\Http\Controllers\AchatController');
	Route::resource('parametre', 'App\Http\Controllers\ParametreController');
	Route::get('/alimentaire/create', [App\Http\Controllers\AlimentaireController::class, 'create'])->name('alimentaire.create');
	Route::get('/alimentaire/{alimentaire}/edit', [App\Http\Controllers\AlimentaireController::class, 'edit'])->name('alimentaire.edit');
	Route::delete('/alimentaire/{alimentaire}/destroy', [App\Http\Controllers\AlimentaireController::class, 'destroy'])->name('alimentaire.destroy');
	Route::get('/livreur/create', [App\Http\Controllers\LivreurController::class, 'create'])->name('livreur.create');
	Route::delete('/livreur/{livreur}/destroy', [App\Http\Controllers\LivreurController::class, 'destroy'])->name('livreur.destroy');
	Route::get('/livraison/create', [App\Http\Controllers\LivraisonController::class, 'create'])->name('livraison.create');
	Route::delete('/livraison/{livraison}/destroy', [App\Http\Controllers\LivraisonController::class, 'destroy'])->name('livraison.destroy');
	Route::get('/livraison/{livraison}/edit', [App\Http\Controllers\LivraisonController::class, 'edit'])->name('livraison.edit');
	Route::get('/catagorie/create', [App\Http\Controllers\CategorieController::class, 'create'])->name('categorie.create');
	Route::get('/categorie/{categorie}/edit', [App\Http\Controllers\CategorieController::class, 'edit'])->name('categorie.edit');
	Route::delete('/categorie/{categorie}/destroy', [App\Http\Controllers\CategorieController::class, 'destroy'])->name('categorie.destroy');
	Route::resource('employe','App\Http\Controllers\UserController');
	Route::get('/markAsReads',[App\Http\Controllers\CommandeController::class, 'markAsReads'])->name('commande.markAsReads');
});





Auth::routes();


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

