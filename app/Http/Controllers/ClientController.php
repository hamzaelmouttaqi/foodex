<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientController extends Controller
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
        return view("clients.index")->with(["clients"=>Client::paginate(25)]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("clients.create") ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    //validation
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
        return redirect()->route('clients.index')->with(["succes"=>"clients ajoutee avec succes"]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit')->with(["clients"=> $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
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
        $client->update([
            "nom"=>$nom ,
            "Prenom"=>$prenom,
            "email"=>$email,
            "tele"=>$tele,
            "date_de_naissance"=>$date_de_naissance,
            "code_postal"=>$code_postal,
            "adresse"=>$adresse,
        ]);
        return redirect()->route('clients.index')->with(["succes"=>"clients modifier avec succes"]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

      return redirect()->route('clients.index')->with(["succes"=>"client supprimer avec succes"]) ;
    }
}
