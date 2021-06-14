<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parametre.index')->with(['parametres'=>Parametre::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function show(Parametre $parametre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function edit(Parametre $parametre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parametre $parametre)
    {
        $this->validate($request,["titre"=>"required"
        ,"nom_magasin"=>"required","tele"=>"required","text_footer"=>"required",
        "adresse"=>'required','icon'=>'image|mimes:png,jpg|dimensions:max_width=70,max_height=70',
        'logo'=>'image|mimes:png,jpg|dimensions:max_width=100,max_height=100']);
        // dd($request);
        $titre=$request->titre;
        $nom_magasin=$request->nom_magasin;
        $adresse=$request->adresse;
        $tele=$request->tele;
        $email=$request->email;
       
        //store data
        if($request->hasFile('icon')){
            unlink(public_path(('uploads/parametres/icon/'. $parametre->icon)));
            $file=$request->file('icon');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/parametres/icon',$filename);
            $parametre->update([     
                "icon"=>$filename,
           ]); 
        }
        
        if($request->hasFile('logo')){
               unlink(public_path(('uploads/parametres/logo/'. $parametre->logo)));
                $file=$request->file('logo');
                $extension=$file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/parametres/logo',$filename);
                $parametre->update([       
                     "logo"=>$filename,           
                ]); 
            }
        $parametre->update([
            "titre"=>$titre ,
             "nom_magasin"=>$nom_magasin,
             "adresse"=>$adresse,
             "tele"=>$tele,
             "email"=>$email
             
        ]); 

        return redirect()->route('parametre.index')->with(["succes"=>"parametre modifiee avec succes"]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parametre $parametre)
    {
        //
    }
}
