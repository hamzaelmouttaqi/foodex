<div class="cart-totals">

    <h2 style="font-size:20px;font-weight:bold">Total</h2>

    <div class="my-4 p-4" style="border: 1px solid rgb(196, 196, 196)">
        <center>
            <table class="table w-75">
                <tr>
                    <td>
                        Sous-total
                    </td>
                    <td align="right">
                        {{ $sum_total }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Reduction
                    </td>
                    <td align="right">
                        0%
                    </td>
                </tr>
            </table>
        </center>
        
        
    <div style="width: 100%;height:50px;"> 
            <a style="width: 100%;
            position: relative;
            line-height: 30px;
            padding: 5px 30px;
            cursor: pointer;
            letter-spacing: .5px;
            border: 1px solid #e0931f;
            border-radius: 0;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            text-decoration: none;
            text-align:center;
            background: #e0931f;
            color: #fff!important;
            "
            wire:click="PasserCommande()">Paiment</a>
    </div>


</div>

</div>
