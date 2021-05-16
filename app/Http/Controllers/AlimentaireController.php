<?php

namespace App\Http\Controllers;

use App\Models\alimentaire;
use App\Models\categorie;
use App\Models\composants;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryComposant;
use App\Models\Size;


class AlimentaireController extends Controller
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
        
      return view('alimentaire.index')->with(["alimentaire"=>alimentaire::with('sizes')->get()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        /*$id=DB::table('category_composants')->select('id')->get();
        foreach($id as $id){
        $category.($id->id)=CategoryComposant::find($id->id)->getcom;
         return;
        } */    
       
       
    return view('alimentaire.create')->with(["compo"=>composants::all(),
    "category"=>CategoryComposant::all(),
    "sizes"=>Size::all(),
    "cat"=>categorie::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["titre"=>"required|unique:alimentaires,titre"
        ,"description"=>"required|min:5"
        ,"composants"=>"required"]);
        //store data
        
        $cat=$request->categorie_id;
        $titleCat=DB::table('categories')->select('nomCat')->where('id',$cat)->value('nomCat');
        $categorie=$titleCat;
        $titre=$request->titre;
        $description=$request->description;
        $composants=$request->composants;
        if($request->hasFile('image')){
            $file=$request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/alimentaire/image',$filename);
        }else{
            $filename='';
        }
        
        $alimentairee=alimentaire::create([
             
            "titre"=>$titre ,
             "description"=>$description,
             "composants"=>$composants,
             "image"=>$filename,
             "categorie_id"=>$cat,
             "categorie"=>$categorie
        ]);   
        $alimentaire=alimentaire::where('id',$alimentairee->id)->get();
        foreach($alimentaire as $alimentaire){
        $sizes=collect($request->input('sizes', []))
        ->map(function($sizes){
            return ['prix'=>$sizes];
        });
        
         $alimentaire->sizes()->sync($sizes);
         return redirect()->route('alimentaire.index')->with(["succes"=>"alimentaire ajoutee avec succes"]) ;
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\alimentaire  $alimentaire
     * @return \Illuminate\Http\Response
     */
    public function show(alimentaire $alimentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\alimentaire  $alimentaire
     * @return \Illuminate\Http\Response
     */
    public function edit(alimentaire $alimentaire)
    {   
        $camp=composants::select('nomComposant')->pluck('nomComposant')->toArray();
        $diff=array_merge(array_diff($camp,$alimentaire->composants)); 
        $inter=array_intersect($camp,$alimentaire->composants);
        return view('alimentaire.edit',compact('inter','diff'))->with(["alimentaire"=>$alimentaire,"compo"=>composants::all(),
        "sizes"=>Size::all(),"category"=>CategoryComposant::all(),
        "cat"=>categorie::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\alimentaire  $alimentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, alimentaire $alimentaire)
    {
        $this->validate($request,["titre"=>"required"
        ,"description"=>"required|min:5"
        ,"composants"=>"required"]);
        //store data
        if($request->hasFile('image')){
            //unlink(public_path(('uploads/alimentaire/image/'. $alimentaire->image)));
            $file=$request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/alimentaire/image',$filename);
            $cat=$request->categorie_id;
            $titleCat=DB::table('categories')->select('nomCat')->where('id',$cat)->value('nomCat');
            $categorie=$titleCat;
            $titre=$request->titre;
            $description=$request->description;
            $composants=$request->composants;
            $alimentaire->update([
                "titre"=>$titre ,
                "description"=>$description,
                "composants"=>$composants,
                "image"=>$filename,
                "categorie_id"=>$cat,
                "categorie"=>$categorie
            ]);  
            
                $sizes=collect($request->input('sizes', []))
                ->map(function($sizes){
                    return ['prix'=>$sizes];
                });
                
                 $alimentaire->sizes()->sync($sizes);
                 return redirect()->route('alimentaire.index')->with(["succes"=>"alimentaire modifie avec succes"]) ;
            
        }
        else{
            $cat=$request->categorie_id;
            $titleCat=DB::table('categories')->select('nomCat')->where('id',$cat)->value('nomCat');
            $categorie=$titleCat;
            $titre=$request->titre;
            $description=$request->description;
            $composants=$request->composants;
            $alimentaire->update([
                "titre"=>$titre ,
                "description"=>$description,
                "composants"=>$composants,
                "categorie_id"=>$cat,
                "categorie"=>$categorie
            ]);   
            
                $sizes=collect($request->input('sizes', []))
                ->map(function($sizes){
                    return ['prix'=>$sizes];
                });
                
                 $alimentaire->sizes()->sync($sizes);
                 return redirect()->route('alimentaire.index')->with(["succes"=>"alimentaire ajoutee avec succes"]) ;
                    
        }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\alimentaire  $alimentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(alimentaire $alimentaire)
    {  //if(!empty($alimentaire->image)){
        //unlink(public_path(('uploads/alimentaire/image/'. $alimentaire->image)));}
        $alimentaire->delete();
        return redirect()->route('alimentaire.index')->with(["succes"=>"alimentaire ajoutee avec succes"]) ;
            

    }
}
