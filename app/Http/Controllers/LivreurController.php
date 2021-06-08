<?php

namespace App\Http\Controllers;

use App\Models\Livraison;
use App\Models\Livreur;
use Illuminate\Http\Request;

class LivreurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livreur.index')->with(['livreurs'=>Livreur::paginate(6)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livreur.create')->with(['livraisons'=>Livraison::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["nom"=>"required"
        ,"status"=>"required" , "code_postal"=>"required|numeric"]);
        //store data
        
        $nom=$request->nom;
        $codePostal=$request->code_postal;
        $status=$request->status;
        Livreur::create([
            "nom"=>$nom ,
            "code_postal"=>$codePostal,
            "status"=>$status
        ]);  
          return redirect()->route('livreur.index')->with(["succes"=>"livreur ajoutee avec succes"]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livreur  $livreur
     * @return \Illuminate\Http\Response
     */
    public function show(Livreur $livreur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livreur  $livreur
     * @return \Illuminate\Http\Response
     */
    public function edit(Livreur $livreur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Livreur  $livreur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livreur $livreur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livreur  $livreur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livreur $livreur)
    {
        $livreur->delete();
        return redirect()->route('livreur.index')->with(["succes"=>"livreur supprime avec succes"]) ;
    }
    
    public function changeStatusLivreur(Request $request)
    {
        $liv = Livreur::find($request->id);

        $liv->status = $request->status;

        $liv->save();

  

        return response()->json(['success'=>'Status change successfully.']);
    }
}
