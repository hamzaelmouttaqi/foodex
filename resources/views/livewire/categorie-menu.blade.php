
@if (count($alimentaires)>0)
<div class="col-md-6">
    <center>
        <h1 style="color: #CB6318;font-family: 'Lora', serif;
        font-size:50px">MENU</h1>
        <h6 style="margin-bottom: 40px">Our Food Is Made With Love</h6>
        <div class="row">
            @foreach ($alimentaires as $alimentaire)
            
            <div class="col-md-4" style="margin-bottom: 20px">
                <div class="{{ $alimentaire->categorie }} data" > 
                <table border="0" width=200px height=300px >
                    <tr valign='top' height=180px>
                        <td colspan="2" align="center">
                           <img src="{{ asset('uploads/alimentaire/image/'.$alimentaire->image) }}"
                             width="180px" alt="" style="border-radius: 10px;
                           box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-transform: uppercase" align="center">
                            <b>{{ $alimentaire->titre }}</b>
                        </td>
                    </tr>
                    <tr valign='top'>
                        <td align="center" colspan="2">
                            
                            <button data-bs-target="#ali_{{ $alimentaire->id }}" 
                                data-bs-toggle="modal" 
                            class="btn btn-outline-primary">Add To Card</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
            @endforeach
    
        
        </div>
    </center>
</div>

@endif
