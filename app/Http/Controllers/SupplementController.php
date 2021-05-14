<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use Illuminate\Http\Request;
use App\Models\CategorieSupplement;
use Illuminate\Support\Facades\DB;


class SupplementController extends Controller
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
        return view('supplement.index')->with(["supplement"=>Supplement::paginate(25)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplement.create')->with(["catsupp"=>CategorieSupplement::all()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["titre"=>"required|unique:supplements,titre","prix"=>"required"]);

        $titre=$request->titre;
        $catsupp=$request->categorie_id;
        $prix=$request->prix;
        $status=$request->status;
        $titleCat=DB::table('categorie_supplements')->select('title')->where('id',$catsupp)->value('title');
        $categorie=$titleCat;
        Supplement::create([
            "titre"=>$titre ,
            "categorie"=>$categorie,
            "prix"=>$prix,
            "categorie_id"=>$catsupp,
            "status"=>$status
        ]); 
        return redirect()->route('supplement.index')->with(["succes"=>"supplement ajoutee avec succes"]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplement  $supplement
     * @return \Illuminate\Http\Response
     */
    public function show(Supplement $supplement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplement  $supplement
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplement $supplement)
    {
        return view('supplement.edit')->with(["supplement"=>$supplement,"catsupp"=>CategorieSupplement::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplement  $supplement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplement $supplement)
    {
        $this->validate($request,["titre"=>"required","prix"=>"required"]);
        $titre=$request->titre;
        $catsupp=$request->categorie_id;
        $prix=$request->prix;
        $titleCat=DB::table('categorie_supplements')->select('title')->where('id',$catsupp)->value('title');
        $categorie=$titleCat;
        $supplement->update([
            "titre"=>$titre ,
            "categorie"=>$categorie,
            "prix"=>$prix,
            "categorie_id"=>$catsupp,
        ]);  
          return redirect()->route('supplement.index')->with(["succes"=>"supplement modifie avec succes"]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplement  $supplement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplement $supplement)
    {
        $supplement->delete();
        return redirect()->route('supplement.index')->with(["succes"=>"supplement supprimé avec succes"]) ;
    }
    public function changeStatus(Request $request)

    {

        $supplem = Supplement::find($request->id);

        $supplem->status = $request->status;

        $supplem->save();

  

        return response()->json(['success'=>'Status change successfully.']);

    }
}