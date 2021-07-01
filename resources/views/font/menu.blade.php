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
            @livewire('cart-counter')
            <a href="#"><i class="material-icons">search</i></a>
        </div>
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div class='logout' style='float:right;margin-right:-80px'>
              
                <a style="text-decoration: none;color:black" href="{{ route('logout') }}" class="material-icons" onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a>
                <span class="tooltiptext">Logout</span>
            </div>
            <div class="profil"> 
                <a style="text-decoration: none;color:black" href="{{ route('profile.edit') }}" class="material-icons">account_circle</a>
                <span class="tooltiptextprofil">Profil</span>
            </div>
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
            <div class="col-md-3">
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
            </div>
        
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
@livewireScripts 
<script>
    window.addEventListener('closeModal', event => {
        $('.modal').modal('hide');
    })
    window.addEventListener('afficher_meassage', event => {
        swal("Success","{!! Session::get('succes') !!}",'success',{
            button:"OK",
        }); 
    })
    window.addEventListener('swal:modal', event => {
        // swal({
        //     title: event.detail.title,
        //     text: event.detail.text,
        //     icon: 'info',

        // }); 
        swal("Votre ordre est vide",'','info',{
            button:"OK",
        }); 
    })
    
    
</script>
</body>
</html>