<center>
    <table class="table w-75" style="margin-top: 60px" > <!-- table table-bordered text-center mb-0 -->

         
        <tbody> 
            <tr align="center" style="font-size: 20px"> 
                <th class="product-remove">&nbsp;</th>
                <th class="product-thumbnail">&nbsp;</th>
                <th class="product-name">Produit</th>
                <th class="product-price">Prix</th>
                <th class="product-quantity">Quantité</th>
                <th class="product-subtotal">Total</th>
            </tr> 

      

        
            @foreach ($cart as $item)
            <tr class="woocommerce-cart-form__cart-item cart_item" height=100px style="vertical-align: middle" align="center">

                <td valign="center" class="product-remove">
                    <a class="btn btn-light btn-sm" wire:click="removefromCart('{{ $item->rowId }}')">
                        <i class="material-icons" style="font-size: 17px">delete</i>
                    </a>
                </td>

                <td class="product-thumbnail">
                    @php
                        $image=DB::table('alimentaires')->select('image')->where('id',$item->id)->value('image');
                    @endphp
                    <img width="150" height="150" src="{{ asset('uploads/alimentaire/image/'.$image) }}" class="img-fluid" alt="">

                <td class="product-name title" data-title="Product">
                    {{ $item->name }}-{{ $item->options['size'] }}                      
                      </td>

                <td class="product-price title" data-title="Price">
                    {{ $item->price }}  DH                     
                 </td>

                <td class="product-quantity" data-title="Quantity">
                    x{{ $item->qty }}
                </td>

                <td class="product-subtotal" data-title="Total">
                    {{ $item->weight }}  DH                                     
                    </td>
            </tr>
            @endforeach
               
        </tbody> 
    </table> 

</center>
    