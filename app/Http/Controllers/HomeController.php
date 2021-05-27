<?php

namespace App\Http\Controllers;

use App\Models\alimentaire;
use App\Models\Client;
use App\Models\Commande;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        
        return view('dashboard')->with(['alimentaires'=>alimentaire::count('id'),
        'clients'=>Client::count('id'),
        'commandes'=>Commande::count('id'),
        'montant'=>Commande::sum('montant'),
        ]);
    }
}
