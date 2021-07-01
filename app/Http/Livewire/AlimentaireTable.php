<?php

namespace App\Http\Livewire;

use App\Models\alimentaire;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\categorie;
use App\Models\composants;
use App\Models\Client;
use App\Models\Supplement;
use Attribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlimentaireTable extends Component
{   
    public  $quantite = [];
    public  $size =[] ;
    public  $composants_ =[];
    public  $ingredient_ =[];
    public  $quantites =[];
    public  $supplement =[];
    public $comp;
    public $alimentaires;
    public $composants;

    

    public function decrease($alimentaire_id)
    {
        if($this->quantite[$alimentaire_id] != 0){
            $this->quantite[$alimentaire_id]=$this->quantite[$alimentaire_id]-1;
        }
    }
    public function increase($alimentaire_id)
    {
        if($this->quantite[$alimentaire_id] < 10){
            $this->quantite[$alimentaire_id]=$this->quantite[$alimentaire_id]+1;
        }
    }
    public function mount()
    {
        $this->alimentaires=alimentaire::all();
        $this->comp=composants::all();
        foreach($this->alimentaires as $alimentaire){
            $this->quantite[$alimentaire->id]=1;
            foreach($this->comp as $compo){
            $this->quantites[$alimentaire->id][$compo->nomComposant]=1;
        }
        }
    }
    public function render()
    {   
        
        return view('livewire.alimentaire-table')->with(["clients"=>Client::all(),
        "alimentaires"=>alimentaire::with('sizes','composants')->orderBy('categorie')->get(),
        "supplements"=>Supplement::all(),
        "categories"=>categorie::all(),
        "compos"=>composants::all(),
        ]);
    }
    public function addToCart($alimentaire_id)
    {   
       
        $alimentaire=alimentaire::findOrFail($alimentaire_id);
        $pri = 0;
        $cm= array();
        if($this->composants_){
            foreach($this->composants_[$alimentaire_id] as $com){
            if($com!=false){
                array_push($cm,$com);
            }
        }
    }
        else{
            $cm=[];
        }  
        if($this->ingredient_){
        $ingredi=$this->ingredient_[$alimentaire_id];
        
        $ingre=array();
           foreach($ingredi as $ing){
               if($ing!=false){
           $prii = DB::table('composants')->select('prix')->where('nomComposant',$ing)->value('prix') ;
           $qte =$this->quantites[$alimentaire_id][$ing];
           $prii = $prii*$qte;
           $pri = $pri + $prii ; 
           $cop = $ing.'('.$qte.')';
           array_push($ingre,$cop);
               }
           }
        }
        else{
            $ingre=[];
        }
        $mer=array_merge($cm,$ingre);
        $compAlim=json_encode($mer);
        list($value1,$value2)=explode('|',$this->size[$alimentaire_id]);
        $prixSupplement = 0;
        $sp=array();
        if($this->supplement){
        $supplement=$this->supplement[$alimentaire_id]; 
                 
                 foreach($supplement as $sup){
                     if($sup!=false){
                    $prss = DB::table('supplements')->select('prix')->where('titre',$sup)->value('prix') ;
                    $prixSupplement = $prixSupplement + $prss ;
                array_push($sp,$sup); }
                 }}
        else{
            $supplement=[];
        }
        $qty=$this->quantite[$alimentaire_id];
        $cart=Cart::add(['id' => $alimentaire->id, 'name' =>$alimentaire->titre,
         'qty' => $qty, 'price' => $value1+$pri, 'weight' => $prixSupplement+($pri+$value1)*$qty,
         'options' => ['size' => $value2,'composants'=>$compAlim,
         'supplementCommande'=>$sp,
         'prixSupplement'=>$prixSupplement]]);
        
         $this->dispatchBrowserEvent('closeModal');
         $this->emit('cart_updated');
         $this->emit('total_updated');
         $this->composants_=[];
         $this->ingredient_=[] ;
         $this->size=[];
         $this->supplement=[];
         $supplement=[];
         $cm=[];
         $ingre=[];
         
         $this->mount();

    
    
}

}
