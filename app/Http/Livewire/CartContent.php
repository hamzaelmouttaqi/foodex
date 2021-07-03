<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartContent extends Component
{
    public function render()
    {
        $cart=Cart::content();
        return view('livewire.cart-content',compact('cart'));
    }
    public function removefromCart($row)
    {   
        Cart::remove($row);
       $this->emit('cart_updated');
       $this->emit('total_updated');
    }
}
