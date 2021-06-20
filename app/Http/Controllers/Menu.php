<?php

namespace App\Http\Controllers;

use App\Models\alimentaire;
use App\Models\categorie;
use App\Models\CategoryComposant;
use App\Models\composants;
use App\Models\Client;
use App\Models\Supplement;
use Illuminate\Http\Request;

class Menu extends Controller
{
    public function index()
    {
        return view('font.menu')->with(["clients"=>Client::all(),
        "alimentaires"=>alimentaire::with('sizes','composants')->orderBy('categorie')->get(),
        "supplements"=>Supplement::all(),
        "categories"=>categorie::all(),
        "compos"=>composants::all(),
        ]);
    }
}
