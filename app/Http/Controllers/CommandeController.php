<?php

namespace App\Http\Controllers;

use App\Models\alimentaire;
use App\Models\categorie;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Supplement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth');}
    public function index()
    {   
        return view('commande.index')->with(["commandes"=>Commande::with('clients')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('commande.create')->with(["clients"=>Client::all(),"alimentaires"=>alimentaire::with('sizes','composants')->get(),
        "supplements"=>Supplement::all(),
        "categorie"=>categorie::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["id_client"=>"required"
        ]);
       
        $id_client=$request->id_client;
        $datecommande=$request->created_at;
        $nom=DB::table('clients')->select('nom')->where('id',$id_client)->value('nom');
        $Prenom=DB::table('clients')->select('Prenom')->where('id',$id_client)->value('Prenom');
        $nom_client=$nom.' '.$Prenom;
        $commandee=Commande::create([
            'id_client'=>$id_client,
            'nom_client'=>$nom_client,
            'date_commande'=>$datecommande,
            
         ]);
         
         $commande=Commande::where('id',$commandee->id)->first() ;
         $alimentaire=$request->ali;
         if($commande !== null) { 
             foreach($alimentaire as $alim){
                 $composants=collect($request->input('alimentaire_'.$alim));
                 
                 list($value1,$value2)=explode('|',$_POST['sizes_'.$alim]);
                 $supplement=collect($request->input('supplement_'.$alim));
                 
                 $prixSupplement = 0;
                 foreach($supplement as $sup){
                    $prss = DB::table('supplements')->select('prix')->where('titre',$sup)->value('prix') ;
                    //dd($prss);
                    $prixSupplement = $prixSupplement + $prss ; 
                 }
                 //->map(function($alimentaire){ return ['composantCommande' => $alimentaire]});
                  $commande->alimentaires()->attach($alim, ['composantCommande' => $composants,
                  'prixSize'=>$value1,'sizeAlimentaire'=>$value2,
                  'supplementCommande'=>$supplement,
                  'prixSupplement'=>$prixSupplement,'prixAlimentaire'=>$value1+$prixSupplement]);
             }
           
        // // $composantCommande=$request->composantCommande;
        // // $camp=(json_encode(array_values($composantCommande)));
        // // $alimentaire=$request->alimentaire;
        
        // //  foreach($commande as $comm){
        // //     foreach($alimentaire as $alim){
        // //      $comm->alimentaires()->sync([
        // //      $alim=>['composantCommande'=>$camp]
        // //  ]);
        
        // }
    }
    return redirect()->route('commande.index')->with(["succes"=>"commande ajouter avec succes"]) ;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        return view('commande.edit')->with(['commande'=>$commande,"clients"=>Client::all(),"alimentaires"=>alimentaire::with('sizes','composants')->get(),
        "supplements"=>Supplement::all(),
        "categorie"=>categorie::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        $this->validate($request,["id_client"=>"required"
        ]);
        $id_client=$request->id_client;
        $montant=$request->montant;
        $datecommande=$request->created_at;
        $nom=DB::table('clients')->select('nom')->where('id',$id_client)->value('nom');
        $Prenom=DB::table('clients')->select('Prenom')->where('id',$id_client)->value('Prenom');
        $nom_client=$nom.' '.$Prenom;
        $commande->update([
            'id_client'=>$id_client,
            'nom_client'=>$nom_client,
            'date_commande'=>$datecommande,
            'montant'=>$montant
         ]);
         return redirect()->route('commande.index')->with(["succes"=>"commande modifier avec succes"]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commande.index')->with(["succes"=>"commande supprime avec succes"]) ;

    }
    public function changeStatut(Request $request)

    {

        $commande = Commande::find($request->id);

        $commande->status = $request->status;

        $commande->save();

  

        return response()->json(['success'=>'Status change successfully.']);
        

    }
    

}
