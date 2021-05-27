<?php

namespace App\Http\Controllers;

use App\Models\composants;
use Illuminate\Http\Request;
use App\Models\CategoryComposant;
use Illuminate\Support\Facades\DB;

class ComposantsController extends Controller
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
        return view('composants.index')->with(["composant"=>composants::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('composants.create')->with(["CatCom"=>CategoryComposant::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["nomComposant"=>"required|unique:composants,nomComposant"
        ,"Category_id"=>"required","prix"=>"required",
        "image"=>'required']);
        //store data
        $prix=$request->prix;
        $nomComposant=$request->nomComposant;
        $cat=$request->Category_id;
        $titleCat=DB::table('category_composants')->select('title')->where('id',$cat)->value('title');
        $categorie=$titleCat;
        
        if($request->hasFile('image')){
            $file=$request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/composants/image',$filename);
        }else{
            $filename='';
        }
        composants::create([
            "nomComposant"=>$nomComposant ,
            "categorie"=>$categorie,
            "image"=>$filename,
            "Category_id"=>$cat,
            "prix"=>$prix
        ]);    return redirect()->route('composants.index')->with(["succes"=>"composant ajoutee avec succes"]) ;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\composants  $composants
     * @return \Illuminate\Http\Response
     */
    public function show(composants $composants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\composants  $composant
     * @return \Illuminate\Http\Response
     */
    public function edit(composants $composant)
    {
        return view('composants.edit')->with(["composant"=>$composant,"CatCom"=>CategoryComposant::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\composants  $composant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, composants $composant)
    {
        $this->validate($request,["nomComposant"=>"required"
        ,"Category_id"=>"required"]);
        //store data
        if($request->hasFile('image')){
            unlink(public_path(('uploads/composants/image/'. $composant->image)));
            $file=$request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/composants/image',$filename);
            $nomComposant=$request->nomComposant;
            $cat=$request->Category_id;
            $titleCat=DB::table('category_composants')->select('title')->where('id',$cat)->value('title');
            $categorie=$titleCat;
            $prix=$request->prix;
            $composant->update([
                "nomComposant"=>$nomComposant ,
                 "categorie"=>$categorie,
                 "image"=>$filename,
                 "Category_id"=>$cat,
                 "prix"=>$prix
            ]);    return redirect()->route('composants.index')->with(["succes"=>"composant modifiee avec succes"]) ;
        }
        else{
            $nomComposant=$request->nomComposant;
            $cat=$request->Category_id;
            $titleCat=DB::table('category_composant')->select('title')->where('id',$cat)->value('title');
            $categorie=$titleCat;
            $prix=$request->prix;
            $composant->update([
                "nomComposant"=>$nomComposant ,
                 "categorie"=>$categorie,
                 "Category_id"=>$cat,
                 "prix"=>$prix
            ]);    return redirect()->route('composants.index')->with(["succes"=>"composant modifiee avec succes"]) ;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\composants  $composants
     * @return \Illuminate\Http\Response
     */
    public function destroy(composants $composant)
    {
        if(!empty($composant->image)){
            unlink(public_path(('uploads/composants/image/'. $composant->image)));}
            $composant->delete();
            return redirect()->route('composants.index')->with(["succes"=>"composant supprime avec succes"]) ;
                
    }
}
