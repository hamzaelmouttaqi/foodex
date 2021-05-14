<?php

namespace App\Http\Controllers;

use App\Models\avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
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
         
        return view('Avis.index')->with(["avis"=>avis::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function show(avis $avis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function edit(avis $avis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, avis $avis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function destroy(avis $avis)
    {
        $avis->delete();
        return redirect()->route('Avis.index')->with(["succes"=>"Avis supprime avec succes"]) ;
    }
}
