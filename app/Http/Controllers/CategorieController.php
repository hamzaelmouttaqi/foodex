<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
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
        return view('categorie.index')->with(["categorie"=>categorie::paginate(25)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categorie.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["nomCat"=>"required|unique:categories,nomCat"
        ,"status"=>"required"]);
        //store data
        
        $nomCat=$request->nomCat;
        $status=$request->status;
        categorie::create([
            "nomCat"=>$nomCat ,
            "status"=>$status
        ]);  
          return redirect()->route('categorie.index')->with(["succes"=>"categorie ajoutee avec succes"]) ;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(categorie $categorie)
    {
        return view('categorie.edit')->with(["categorie"=>$categorie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categorie $categorie)
    {
        $this->validate($request,["nomCat"=>"required|unique:categories,nomCat"
        ,"status"=>"required"]);
        //store data
        
        $nomCat=$request->nomCat;
        $status=$request->status;
        $categorie->update([
            "nomCat"=>$nomCat ,
            "status"=>$status
        ]);  
          return redirect()->route('categorie.index')->with(["succes"=>"categorie modifie avec succes"]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('categorie.index')->with(["succes"=>"categorie supprime avec succes"]) ;

    }
}
