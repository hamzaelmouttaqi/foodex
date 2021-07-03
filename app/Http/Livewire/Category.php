<?php

namespace App\Http\Livewire;

use App\Models\categorie;
use Livewire\Component;

class Category extends Component
{
    public function render()
    {   $categories=categorie::all();
        return view('livewire.category',compact('categories'));
    }
    public function getalimentaire($id)
    {    
        $this->emit('update',$id);
    
    }
}
