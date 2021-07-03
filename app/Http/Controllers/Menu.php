<?php

namespace App\Http\Controllers;

use App\Models\alimentaire;
use App\Models\categorie;
use App\Models\CategoryComposant;
use App\Models\composants;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Supplement;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Menu extends Controller
{
    public function index()
    {
        $id=DB::table('users')->select('id_client')->where('id',Auth::id())->value('id_client');
        $commandes=Commande::with('clients')->where('id_client',$id)->where('status',1)->get();
        return view('font.menu',compact('id','commandes'))->with(["clients"=>Client::all(),
        "alimentaires"=>alimentaire::with('sizes','composants')->orderBy('categorie')->get(),
        "supplements"=>Supplement::all(),
        "categories"=>categorie::all(),
        "compos"=>composants::all(),
        ]);
    }
    public function cart_content()
    {
        $count=Cart::count();

        
        if($count==0){
            session()->flash('statut', 'Votre Order est vide');
            return redirect()->route('menu.index');
        }
        $id=DB::table('users')->select('id_client')->where('id',Auth::id())->value('id_client');
        $commandes=Commande::with('clients')->where('id_client',$id)->where('status',1)->get();
        
        return view('font.cart_content',compact('id','commandes'));
    }
}
