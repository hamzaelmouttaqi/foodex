<div class="order">
    
    <table class="table tab1" style="background-color: white;">
       <tr>
           <td colspan="5" align="center" style="color: black">
             <b>My Order</b>
           </td>
       </tr>
        @if (!$cart)
        <tr height=250px>
            <td colspan="5" align="center" style="color: black;padding-top: 30px" valign="center"><i class="material-icons-outlined" 
                style="font-size: 120px;color: black">shopping_bag</i><br>
            
                Browse our menu and start adding items to your order
            
            </td>
        
        
        
           
        </tr>
        @else
        <tr align="center" style="background-color: white">
            <td>
                alim
            </td>
            <td>
                quantite
            </td>
            <td>
                price
            </td>
            <td>
                total
            </td>
            <td>
                action
            </td>
         </tr>
        @foreach ($carts as $item)
            
            <tr style='font-weight:bold'>
                <td>
                    {{ $item->name }}({{ $item->options['size'] }})
                </td>   

                <td align="center">
                    x{{ $item->qty }}
                </td>
                <td>
                    {{ $item->price }}DH
                </td>
                <td>
                    {{ $item->weight }}DH
                </td>
                <td>
                    <a class="btn btn-light btn-sm" wire:click="removefromCart('{{ $item->rowId }}')">
                        <i class="material-icons" style="font-size: 17px">delete</i>
                    </a>
                </td>
            </tr>
         @endforeach
            
        
        @endif
        <tr>
            <td colspan="3" align="center" style="padding-top: 3%"><b>Total :</b></td>
            @livewire('calcule-total')
        </tr>
        <tr >

            <td colspan="5" align="center">
                <a class="btn btn-primary" href="{{ route('cart_content') }}">Order Now</a>
            </td>
        </tr>
    </table>
</div>