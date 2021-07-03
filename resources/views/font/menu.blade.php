<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('font/menu.css') }}">
    <script src="{{ asset('font/menu.js') }}" language="JavaScript" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>FOODEX</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    @livewireStyles
</head>
<body>
    {{-- MODEL --}}
    <div class="modal fade" id="Modalcommande" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalLabel">Votre Commande</h5>
              <button type="button" class="btn btn-dark btn-sm"  data-bs-dismiss="modal" aria-label="Close"><i class="material-icons">close</i></button>
            </div>
            <div class="modal-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Status</th>
                            <th scope="col"><center>Elements de commande</center></th>
                            <th scope="col">Date commande</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Livreur</th>
                
                            <th scope="col"><center>action</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($commandes as $commande)
                              <tr>
                                  <td>
                                    @if ($commande->status == '1')
                                        <button class="btn btn-danger">en cours</button> 
                                    @else
                                    <button class="btn btn-success">completé</button> 
                                    @endif
                                  </td>
                                  
                                    <td>
                                      @foreach ($commande->alimentaires as $alim)
                                          
                                          <table class="table" border="0" border-collapse="collapse" >
                                            <tr>
                                              <td width=80>{{$alim->titre}}</td>
                                              <td width=80>({{$alim->pivot->sizeAlimentaire}}) </td> 
                                              <td width=80>Qte : {{$alim->pivot->quantite}}</td>
                                                
                                                  <td>
                                                    <table class="{{$commande->id}}{{$alim->id}}" style="display: none" >
                                                      <tr>
                                                        <th scope="col">Composants</th>
                                                        <th scope="col">Supplement</th>
                                                      </tr>
                                                      <tr>
                                                        <td width=120>
                                                          @foreach (json_decode($alim->pivot->composantCommande) as $comp)
                                                           <li>{{$comp}}</li>
                                                          @endforeach
                                                        </td>
                                                        <td width=85>
                                                          @foreach (json_decode($alim->pivot->supplementCommande) as $sup)
                                                          <li>{{$sup}}</li>
                                                          @endforeach
                                                        </td>
                                                      </tr>
                                                    </table>
                                                    
                                                  </td>
                                                  
                                                  <td><button type="button" class="sh alim{{$commande->id}}{{$alim->id}}" style="border-radius: 25px" data-id="{{$commande->id}}{{$alim->id}}">+</button></td>
                                                  <td><button type="button" class="ssh aalim{{$commande->id}}{{$alim->id}}"  data-id="{{$commande->id}}{{$alim->id}}" style="display: none ; border-radius: 25px">-</button></td>
                                            </tr>
                                          </table>
                                      
                                  @endforeach
                                  
                                </td>
                                
                              
                              <td>{{$commande->created_at}}</td>
                              
                              
                              <td>{{$commande->montant }} dh</td>
                              <td>
                                {{DB::table('livreurs')->select('nom')->where('id',$commande->id_livreur)->value('nom')}}
                              </td>
                              <td class="d-flex flex-row justify-content-center align-items-center">
                                <a class="btn  btn-light btn-sm ml-2" href="{{ route('facture',$commande->id)}}" ><i class="material-icons">receipt_long</i></a>
                            </td>
                                
                          </tr>
                          @endforeach
            
                        </tbody>
                    </table>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    @livewire('alimentaire-table')
    {{-- FIN MODEL --}}
    <header class="head">
        <a href="#" class="logo"><img src="{{ asset('img/foodex_noir.png') }}" alt=""></a>
        <!-- <div id="menu-bar" class="fas fa-bars"></div> -->
        <nav class="navbar">
            <a href="/#home">HOME</a>
            <a href="/#about">ABOUT</a>
            <a href="/#menu">MENU</a>
            <a href="/#review">REVIEW</a>
            <a href="/#contact">CONTACT</a>
        </nav>
        <div class="left">
            @php
            $id=DB::table('users')->select('id_client')->where('id',Auth::id())->value('id_client');
            $num=DB::table('commandes')->where('id_client',$id)->where('status',1)->count();
        @endphp
        <a class="nv" href="#" style="text-decoration: none;color: black">
            <i class="material-icons" style="font-size: 30px">electric_moped</i>
            <label style="font-size:20px">({{ $num }})</label>
        </a>
            @livewire('cart-counter')
           
        </div>
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div class='logout' style='float:right;margin-right:-80px'>
              
                <a style="text-decoration: none;color:black" href="{{ route('logout') }}" class="material-icons" onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a>
                <span class="tooltiptext">Logout</span>
            </div>
            @if (Auth::user()->hasRole('administrator')||Auth::user()->hasRole('employee'))
              <div class="profil"> 
                <a style="text-decoration: none;color:black" href="{{ route('profile.edit') }}" class="material-icons">account_circle</a>
                <span class="tooltiptextprofil">Profil</span>
            </div>
            @endif
            @if (Auth::user()->hasRole('client'))
            <div class="profil"> 
              <a style="text-decoration: none;color:black" href="{{ route('profile.client',$id) }}" class="material-icons">account_circle</a>
              <span class="tooltiptextprofil">Profil</span>
          </div>
            @endif
        @endauth
        @guest
        <div class='login'  style='float:right;'>
            <a style="text-decoration: none;color:black" href="{{ route('login') }}" class="material-icons">login</a>
            <span class="tooltiptextlogin">Login</span>
            
        </div>
       
        @endguest
       
       
    </header>
    @livewire('message')
    <div class="content">
       
        <div class="row">
           @livewire('category')
            @livewire('categorie-menu')
            {{-- <div class="col-md-3">
                <div class="products">
                    <h4>Products</h4>
                    <nav class="productNav">
                        <ul>
                            @foreach ($categories as $categorie)
                                <li class="nav-item">
                                    <div class="lien" id="{{ $categorie->nomCat }}">
                                        <div class="car" style="display: none !important;"></div>
                                        <a  class="nomCat" 
                                        data-id="{{ $categorie->nomCat }}"
                                        href="#{{ $categorie->nomCat }}"
                                            style="text-transform: uppercase;">{{ $categorie->nomCat }}</a>
                                    </div>
                                </li>
                            @endforeach
                            
                            
                        </ul>
                    </nav>
                </div>
            </div>
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
            </div> --}}
        
        <div class="col-md-3">
            @livewire('cart-alimentaire')
        </div>
    </div>
    </div>
    <footer>
        <div class="tb">
            <table class="tab" >
                <tr>
                    <th style="text-align: center;">About</th>
                    <th style="text-align: left;padding-left:250px">Get News & Offers</th>
                    <th style="text-align: center;">Contacts</th>
                </tr>
                <tr></tr>
                <tr>
                    <td>
                        
                            FOODEX is a restaurant owned and <br> 
                                run by chef MASSIMO in <br>
                                  Casablanca Morocco
                        
                    </td>
                    <td>
                        <div class="input-group mb-3" style="margin-top:30px ">
                            <input type="text" class="form-control" placeholder="Your email" aria-label="Your email" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button">subscribe</button>
                            </div>
                          </div>
                    </td>
                    <td>
                        
                                n° 21 <br>
                           Cite Communale <br>
                        Casablanca , MOROCCO
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        
                            Reservations required for parties <br>
                                of 6 or more.
                        
                    </td>
                    <td></td>
                    <td>
                        
                            +212655946442
                        
                    </td>
                </tr>
            </table> 
            <div class="cp">
                COPYRIGHT © FOODEX 2021. ALL RIGHT RESERVED
            </div>
        </div>
    </footer>
    @if (session()->has("succes"))
    <script>
        swal("Success","{!! Session::get('succes') !!}",'success',{
            button:"OK",
        }); 
    </script>
    @endif
    @if (session()->has("statut"))
    <script>
        swal("Info","{!! Session::get('statut') !!}",'info',{
            button:"OK",
        }); 
    </script>
    @endif
       
           
       
@livewireScripts 
<script>
    $(function() {
            $(".nv").on('click',function() {
                $("#Modalcommande").modal('show')
            })
        })
        $(function() {
      $('.sh').on('click',function() {
        var id = $(this).data('id'); 
        $("."+id).show();
        $('.alim'+id).hide();
        $('.aalim'+id).show();
    })
      
    $('.ssh').on('click',function() {
        var id = $(this).data('id'); 
        $("."+id).hide();
        $('.aalim'+id).hide();
        $('.alim'+id).show();
    })
    })
    window.addEventListener('closeModal', event => {
        $('.modal').modal('hide');
    })
    
    
    
</script>
</body>
</html>