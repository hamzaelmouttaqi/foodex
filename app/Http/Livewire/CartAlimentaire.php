<?php

namespace App\Http\Livewire;

use App\Models\Commande;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function PasserCommande($id)
    {   
        if(Auth::check()){

        $total=0;
        $carts=Cart::content();
        $commandee=Commande::create([
            'id_client'=>'1',
            'nom_client'=>'hamza',
        ]);
        $commande=Commande::where('id',$commandee->id)->first() ;
        
        foreach($carts as $row){
            
            $supplement=collect(array_values($row->options['supplementCommande']));
            
            $commande->alimentaires()->attach($row->id, [
            'composantCommande' => $row->options['composants'],
            'quantite'=>$row->qty,
            'prixSize'=>$row->price,'sizeAlimentaire'=>$row->options['size'],
            'supplementCommande'=> $supplement,
            'prixSupplement'=>$row->options['prixSupplement'],
            'prixAlimentaire'=>$row->weight
            ]);
        }
        foreach($carts as $row){
            $total=$total+$row->weight;
        }
        $sum_total=number_format((float)$total, 2, '.', '');
        DB::table('commandes')->where('id',$commandee->id)->update(['montant'=>$total]);
        $code_postal=DB::table('clients')->select('code_postal')->where('id',$commande->id_client)->value('code_postal');
        $livreur=DB::table('livreurs')->select('id')->where('code_postal',$code_postal)->where('status',1)->inRandomOrder()->value('id');
        DB::table('commandes')->where('id',$commandee->id)->update(['id_livreur'=>$livreur]);
             $number=DB::table('commandes')->select('id')->where('id_livreur',$livreur)->count();
             if($number>4){
                DB::table('livreurs')->where('id',$livreur)->update(['status'=>0]);
             }
             foreach($carts as $row){
                 $this->removefromCart($row->rowId);
             }
             session()->flash('message', 'order successfully traited.');
             $this->dispatchBrowserEvent('afficher_meassage');
             
    }
    else{
        session()->flash('message', 'identifier Vous Pour passer la commande');
        return redirect()->to('/login');
    }
    }
    
        
    
}
