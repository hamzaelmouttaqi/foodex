<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('achat.index')->with(['achats'=>Achat::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('achat.create')->with(['fournisseurs'=>Fournisseur::with('produits')->get(),'produits'=>Produit::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["fournisseurId"=>"required"]);
            $fournisseur_id=$request->fournisseurId;
            
             $achat=Achat::create([
                 "fournisseur_id"=>$fournisseur_id 
             ]);
            

            $produits_id=array_keys($request->quantite);
            $achat=Achat::where('id',$achat->id)->first();
            $prixTotal = 0 ;
            foreach($produits_id as $prod){   
                $quantite = $request->input('quantite', []);
                $quantite = $quantite[$prod];
                $prix = DB::table('fournisseur_produit')->select('prix_unitaire')->where('fournisseur_id',$fournisseur_id)
                ->where('produit_id',$prod)->value('prix_unitaire');
                $prix = $prix * $quantite;
                $achat->produits()->attach($prod, ['quantite' =>$quantite ,'prix' => $prix ]);
                $prixTotal = $prixTotal + $prix ;
            }
            DB::table('achats')->where('id',$achat->id)->update(['prix_total'=>$prixTotal]);
            return redirect()->route('achat.index')->with(["succes"=>"achat ajoutee avec succes"]) ;
    }
//     public function store(Request $request)
//     {
        
//         $this->validate($request,[
//         "id_fournisseur"=>"required",
//     ]);
//         $id_fournisseur=$request->id_fournisseur;
//         $achat=Achat::create([
//             "fournisseur_id"=>$id_fournisseur 
//         ]);
//         $produits_id=array_keys($request->produit);
//         $achats=Achat::where('id',$achat->id)->get();
//         $prix_unitaire=DB::table('fournisseur_produit')->select('prix_unitaire')->where('fournisseur_id',$id_fournisseur)
//         ->whereIn('produit_id',$produits_id)->pluck('prix_unitaire');
//         foreach($achats as $achat){
//             $produits=collect($request->input('produit', []))
//             ->map(function($produits){
//                 return ['quantite'=>$produits];
//             });
            
        
//             $achats->produits()->sync($produits);

//         return redirect()->route('fournisseur.index')->with(["succes"=>"fournisseur ajoutee avec succes"]) ;

// }}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function show(Achat $achat)
    {
        return view('achat.facture')->with(['achat'=>Achat::with('fournisseur','produits')->where('id',$achat->id)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function edit(Achat $achat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Achat $achat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Achat $achat)
    {
        $achat->delete();
        return redirect()->route('achat.index')->with(["succes"=>"achat supprimme avec succes"]) ;
    }
}
