<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function index()
    {
        return view('fournisseur.index')->with(["fournisseur"=>Fournisseur::paginate(25)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("fournisseur.create")->with(['produits'=>Produit::all()]) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["nom"=>"required","email"=>"required","tele"=>"required","adresse"=>"required"]);
        
        $nom=$request->nom;
        $email=$request->email;
        $tele=$request->tele;
        $adresse=$request->adresse;
        $fournisseurr=Fournisseur::create([
            "nom"=>$nom ,
            "email"=>$email,
            "tele"=>$tele,
            "adresse"=>$adresse,
        ]);
        $fournisseurs=Fournisseur::where('id',$fournisseurr->id)->get();
        foreach($fournisseurs as $fournisseur){
            $produits=collect($request->input('produit', []))
            ->map(function($produits){
                return ['prix_unitaire'=>$produits];
            });
        
            $fournisseur->produits()->sync($produits);

        return redirect()->route('fournisseur.index')->with(["succes"=>"fournisseur ajoutee avec succes"]) ;
    }}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseur.edit')->with(["fournisseur"=> $fournisseur]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $this->validate($request,["nom"=>"required","email"=>"required","tele"=>"required","adresse"=>"required"]);
        //store data
        $nom=$request->nom;
        $email=$request->email;
        $tele=$request->tele;
        $adresse=$request->adresse;
        $fournisseur->update([
            "nom"=>$nom ,
            "email"=>$email,
            "tele"=>$tele,
            "adresse"=>$adresse,
        ]);
        return redirect()->route('fournisseur.index')->with(["succes"=>"fournisseur modifier avec succes"]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();

      return redirect()->route('fournisseur.index')->with(["succes"=>"client supprimer avec succes"]) ;
    }
    public function insert(Request $request)
    {
        $this->validate($request,["titre"=>"required",
        ]);
        //store data
        $titre=$request->titre;
       
        Produit::create([
            "titre"=>$titre ,
           
        ]);
        return redirect()->route('fournisseur.create')->with(["succes"=>"Produit ajoutee avec succes"]) ;
    }
}
