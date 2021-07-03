<?php

namespace App\Http\Livewire;

use App\Models\Commande;
use App\Models\User;
use App\Notifications\notifCommande;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class CartAlimentaire extends Component
{   
    protected $listeners =['cart_updated' =>'render'];
    public function render()
    {   $carts=Cart::content();
        $cart=Cart::content()->count();
        
        return view('livewire.cart-alimentaire',compact('cart','carts'));
    }
    public function removefromCart($row)
    {   
        Cart::remove($row);
       $this->emit('cart_updated');
       $this->emit('total_updated');
    }
    
    
        
    
}
