<?php

namespace App\Http\Livewire;

use App\Models\alimentaire;
use App\Models\categorie;
use Livewire\Component;

class CategorieMenu extends Component
{
    
    public $id_categorie=0;

    protected $listeners =['update'];
    public function update($cat_id)
    {
        $this->id_categorie=$cat_id;
        $this->render();
    }
    
    public function render()

    {   
        $id_c=$this->id_categorie;
        if($id_c>0){
            $alimentaires=alimentaire::with('sizes','composants')->where('categorie_id',$id_c)->orderBy('categorie')->get(); 

        } 
        elseif($id_c==null){
            $alimentaires=alimentaire::with('sizes','composants')->orderBy('categorie')->get();
        }
        return view('livewire.categorie-menu',compact('alimentaires'));
    }
     
       
    
   
}
