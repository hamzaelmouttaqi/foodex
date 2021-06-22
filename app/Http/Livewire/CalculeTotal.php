<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CalculeTotal extends Component
{public float $total;
    
    protected $listeners =['total_updated' =>'render'];
    public function render()
    {   
        $this->total=0.00;
        $cart=Cart::content();
        foreach($cart as $row){
            $this->total=$this->total+$row->weight;
        }
        $sum_total=number_format((float)$this->total, 2, '.', '');
        
       
        return view('livewire.calcule-total',compact('sum_total'));
    }
}
