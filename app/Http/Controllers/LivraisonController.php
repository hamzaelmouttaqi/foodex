<?php

namespace App\Http\Controllers;

use App\Models\Livraison;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livraison.index')->with(["livraison"=>Livraison::paginate(25)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livraison.create')->with(["livraison"=>Livraison::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["ville"=>"required"
        ,"code_postal"=>"required" , "prix"=>"required"]);
        //store data
        
        $ville=$request->ville;
        $code_postal=$request->code_postal;
        $prix=$request->prix;
        Livraison::create([
            "ville"=>$ville ,
            "code_postal"=>$code_postal,
            "prix"=>$prix
        ]);  
          return redirect()->route('livraison.index')->with(["succes"=>"ville ajoutee avec succes"]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    public function show(Livraison $livraison)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    public function edit(Livraison $livraison)
    {
        return view('livraison.edit')->with(["livraison"=>$livraison]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livraison $livraison)
    {
        $this->validate($request,["prix"=>"required"]);
        //store data
        
        $ville=$request->ville;
        //$code_postal=$request->code_postal;
        $prix=$request->prix;
        $livraison->update([
            "ville"=>$ville ,
            //"code_postal"=>$code_postal , 
            "prix"=>$prix
        ]);  
          return redirect()->route('livraison.index')->with(["succes"=>"ville modifie avec succes"]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livraison $livraison)
    {
        $livraison->delete();
        return redirect()->route('livraison.index')->with(["succes"=>"ville supprimé avec succes"]) ;
    }
}