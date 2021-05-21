<?php

namespace App\Http\Controllers;

use App\Models\alimentaire;
use App\Models\AlimentaireCommande;
use App\Models\categorie;
use App\Models\Client;
use App\Models\Commande;
use App\Models\composants;
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
        "categorie"=>categorie::all(),
        "compos"=>composants::all()]);
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
        
        $nom=DB::table('clients')->select('nom')->where('id',$id_client)->value('nom');
        $Prenom=DB::table('clients')->select('Prenom')->where('id',$id_client)->value('Prenom');
        $nom_client=$nom.' '.$Prenom;
        $commandee=Commande::create([
            'id_client'=>$id_client,
            'nom_client'=>$nom_client,
            
            
         ]);
         
         $commande=Commande::where('id',$commandee->id)->first() ;
         $alimentaire=$request->ali;
        if($commande !== null) { 
             foreach($alimentaire as $alim){
                 $composants=collect($request->input('alimentaire_'.$alim))->toArray();
                 $ingredient=collect($request->input('ingredient_'.$alim))->toArray();
                 $pri = 0;
                 $ingre=array();
                    foreach($ingredient as $ing){
                    $prii = DB::table('composants')->select('prix')->where('nomComposant',$ing)->value('prix') ;
                    $qte =$request->input('quantite_'.$alim.'_'.$ing);
                    $prii = $prii*$qte;
                    $pri = $pri + $prii ; 
                    $cop = $ing.'('.$qte.')';
                    array_push($ingre,$cop);
                 }
                 $mer=array_merge($composants,$ingre);
                 $compAlim=json_encode($mer);
                 list($value1,$value2)=explode('|',$_POST['sizes_'.$alim]);
                 $supplement=collect($request->input('supplement_'.$alim));
                 
                 $prixSupplement = 0;
                 foreach($supplement as $sup){
                    $prss = DB::table('supplements')->select('prix')->where('titre',$sup)->value('prix') ;
                    $prixSupplement = $prixSupplement + $prss ; 
                 }
                 $qtAlimentaire=$request->input('quantite_'.$alim);
                 //->map(function($alimentaire){ return ['composantCommande' => $alimentaire]});
                  $commande->alimentaires()->attach($alim, ['composantCommande' => $compAlim,
                  'prixSize'=>$value1,'sizeAlimentaire'=>$value2,
                  'supplementCommande'=>$supplement,
                  'prixSupplement'=>$prixSupplement,'prixAlimentaire'=>($value1+$prixSupplement+$pri)*$qtAlimentaire
                  ,'quantite'=>$qtAlimentaire]);
             }
             $total=0;
             foreach ($commande->alimentaires as $alim){   
                $total=$total+ $alim->pivot->prixAlimentaire;
             }
             DB::table('commandes')->where('id',$commandee->id)->update(['montant'=>$total]);
           
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
        return view('commande.facture')->with(['commande'=>Commande::with('clients','alimentaires')->where('id',$commande->id)->get()]);
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
        "categorie"=>categorie::all(),
        "compos"=>composants::all()]);
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
       
        $id_client=$request->id_client;
        $nom=DB::table('clients')->select('nom')->where('id',$id_client)->value('nom');
        $Prenom=DB::table('clients')->select('Prenom')->where('id',$id_client)->value('Prenom');
        $nom_client=$nom.' '.$Prenom;  
         $alimentaire=$request->ali;
        if($commande !== null) { 
             foreach($alimentaire as $alim){
                 $composants=collect($request->input('alimentaire_'.$alim))->toArray();
                 $ingredient=collect($request->input('ingredient_'.$alim))->toArray();
                 $pri = 0;
                 $ingre=array();
                    foreach($ingredient as $ing){
                    $prii = DB::table('composants')->select('prix')->where('nomComposant',$ing)->value('prix') ;
                    $qte =$request->input('quantite_'.$alim.'_'.$ing);
                    $prii = $prii*$qte;
                    $pri = $pri + $prii ; 
                    $cop = $ing.'('.$qte.')';
                    array_push($ingre,$cop);
                 }
                 $mer=array_merge($composants,$ingre);
                 $compAlim=json_encode($mer);
                 list($value1,$value2)=explode('|',$_POST['sizes_'.$alim]);
                 $supplement=collect($request->input('supplement_'.$alim));
                 
                 $prixSupplement = 0;
                 foreach($supplement as $sup){
                    $prss = DB::table('supplements')->select('prix')->where('titre',$sup)->value('prix') ;
                    $prixSupplement = $prixSupplement + $prss ; 
                 }
                 $qtAlimentaire=$request->input('quantite_'.$alim);
                 //->map(function($alimentaire){ return ['composantCommande' => $alimentaire]});
                  $commande->alimentaires()->attach($alim, ['composantCommande' => $compAlim,
                  'prixSize'=>$value1,'sizeAlimentaire'=>$value2,
                  'supplementCommande'=>$supplement,
                  'prixSupplement'=>$prixSupplement,'prixAlimentaire'=>($value1+$prixSupplement+$pri)*$qtAlimentaire
                  ,'quantite'=>$qtAlimentaire]);
             }
             $total=0;
             foreach ($commande->alimentaires as $alim){   
                $total=$total+ $alim->pivot->prixAlimentaire;
             }
             $commande->update([
                'montant'=>$total,
             ]);
        
         return redirect()->route('commande.index')->with(["succes"=>"commande modifier avec succes"]) ;
    }
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
   
    public function supprimer(Request $request)
    {
        $alim=AlimentaireCommande::find($request->id);
        $alim->delete();
        return response()->json(["succes"=>"commande supprime avec succes"]) ;
    }
    public function insert(Request $request)
    {
        $this->validate($request,["nom"=>"required","Prenom"=>"required","email"=>"required","tele"=>"required",
        "date_de_naissance"=>"required","code_postal"=>"required","adresse"=>"required"]);
        //store data
        $nom=$request->nom;
        $prenom=$request->Prenom;
        $email=$request->email;
        $tele=$request->tele;
        $date_de_naissance=$request->date_de_naissance;
        $code_postal=$request->code_postal;
        $adresse=$request->adresse;
        Client::create([
            "nom"=>$nom ,
            "Prenom"=>$prenom,
            "email"=>$email,
            "tele"=>$tele,
            "date_de_naissance"=>$date_de_naissance,
            "code_postal"=>$code_postal,
            "adresse"=>$adresse,
        ]);
        return redirect()->route('commande.create')->with(["succes"=>"clients ajoutee avec succes"]) ;
    }
}
