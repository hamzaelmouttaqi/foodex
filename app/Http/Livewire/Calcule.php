<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\Commande;
use App\Models\User;
use App\Notifications\notifCommande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Calcule extends Component
{
    
    public float $total;
    
        protected $listeners =['total_updated' =>'render'];
        public function render()
        {   
            $this->total=0.00;
            $cart=Cart::content();
            foreach($cart as $row){
                $this->total=$this->total+$row->weight;
            }
            $sum_total=number_format((float)$this->total, 2, '.', '');
            
           
            return view('livewire.calcule',compact('sum_total'));
        }
        public function removefromCart($row)
    {   
        Cart::remove($row);
       $this->emit('cart_updated');
       $this->emit('total_updated');
    }
        public function PasserCommande()
        {   
            if(Auth::check()){
            $total=0;
            $carts=Cart::content();
            $cart_count=$carts->count();
            
            $commandee=Commande::create([
                'id_client'=>Auth::user()->id_client,
                'nom_client'=> Auth::user()->name ,
            ]);
            $date_de_naissance=DB::table('clients')->select('date_de_naissance')->where('id',Auth::user()->id_client)->value('date_de_naissance');
            $date_nai=date('m-d',strtotime($date_de_naissance));
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
            if($date_nai==date('m-d')){
                $total=$total-$total*(0.2);
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
                 $commandess = DB::table('commandes')->where('id',$commandee->id)->first();
                 $users = User::whereHas('roles', function($q)
                    {
                        $q->where('name', 'administrator');})->get();
    
                    foreach($users as $user ){
                        $user->notify(new notifCommande($commandess));
                    }
                    session()->flash('succes', 'order successfully traited.');
                 return redirect()->route('menu.index');
                
        }
        else{
            session()->flash('message', 'identifier Vous Pour passer la commande');
            return redirect()->to('/login');
        }
        }
    
}
