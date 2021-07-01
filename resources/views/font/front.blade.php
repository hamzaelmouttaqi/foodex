<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset("font/style.css") }}">
    <link rel="stylesheet" href="{{ asset('owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('owlcarousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('font/css/bootstrap.css') }}">
    <script src="{{ asset('font/js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('font/js/popper.js') }}"></script>
    <script src="{{ asset("font/style.js") }}"></script>
    <script src="{{ asset('owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js" integrity="sha512-ZKNVEa7gi0Dz4Rq9jXcySgcPiK+5f01CqW+ZoKLLKr9VMXuCsw3RjWiv8ZpIOa0hxO79np7Ec8DDWALM0bDOaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    @livewireStyles
</head>
<body>
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
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
    <div class="social">
        <ul class="social-media">
            <li class="change">
                <i class="fab fa-instagram fa-2x"></i>
                <div class="tooltip">Facebook</div>
            </li>
            <li class="change"><i class="fab fa-facebook-f fa-2x" ></i></li>
            <li class="change"><i class="fab fa-twitter fa-2x"></i></li>
            <li class="change"><i class="fab fa-pinterest-p fa-2x"></i></li>
        </ul>
    </div>
   
    <div class="content">  
       
        <div class="home" id='home'>
            <!-- <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="sushi4.jpg" class="image" alt="...">
                  </div>
                  <div class="carousel-item ">
                    <img src="pizza.jpg" class="image" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="humberger.jpg" class="image" alt="...">
                  </div>
                </div>
              </div> -->
              <div id="slideshow" >
                <div>
                  <img src="{{ asset('img/first2.jpg') }}" class="image" >
                </div>
                {{-- <div>
                    <img src="{{ asset('img/pizza-min.jpg') }}" class="image" alt="...">
                </div>
                <div>
                    <img src="{{ asset('img/humberger-min.jpg') }}" class="image" alt="...">
                </div> --}}
              </div>
              <div class="slug">
                <h2>ALL YOU NEED IS LOVE BUT A LITTLE</h2>
                <div class="words">
                    <span>SUSHI</span>
                    <span>PIZZA</span>
                    <span>BURGER</span>
                </div>
                <h2 class="bot"> NOW AND THEN DOESN'T HURT </h2>
              </div>
                <header class="head">
                    <a href="#" class="logo"><img src="{{ asset('img/foodex_blanc.png') }}" alt=""></a>
                    <!-- <div id="menu-bar" class="fas fa-bars"></div> -->
                    <div class="wrapper">
                        <!-- Sidebar -->
                        <nav id="sidebar" class="active">
                            
                    
                            <ul class="list-unstyled components" class="navbar-nav mr-auto">
                              <li class="nav-item"><a class="nav-link" href="#home">HOME</a></li>
                              <li class="nav-item"><a class="nav-link" href="#about">ABOUT</a></li>
                              <li class="nav-item"><a class="nav-link" href="#menu">MENU</a></li>
                              <li class="nav-item"><a class="nav-link" href="#ordernow">GALLERY</a></li>
                              <li class="nav-item"><a class="nav-link" href="#gallery">REVIEW</a></li>
                              <li class="nav-item"><a class="nav-link" href="#contact">CONTACT</a></li>
                            </ul>
                        </nav>
                    
                    
                        <div id="content">
                            <nav class="navbar navbar-expand-lg ">
                        
                                <button  type="button" id="sidebarCollapse" style="background-color: transparent">
                                    <span class="navbar-toggler-icon">
                                        <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
                                    </span>
                                </button>
                                
                            </nav>
                        </div>
                    </div>
                    <div class="left">
                        @php
                            $id=DB::table('users')->select('id_client')->where('id',Auth::id())->value('id_client');
                            $num=DB::table('commandes')->where('id_client',$id)->where('status',1)->count();
                        @endphp
                        <a class="nv" href="#" style="text-decoration: none">
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
              
                <a style="text-decoration: none;color:white" href="{{ route('logout') }}" class="material-icons" onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a>
                <span class="tooltiptext">Logout</span>
            </div>
            <div class="profil">
                <a style="text-decoration: none;color:white" href="{{ route('profile.client',$id) }}" class="material-icons">account_circle</a>
                <span class="tooltiptextprofil">Profil</span>
            </div>
        @endauth
        @guest
        <div class='login'  style='float:right;'>
            <a style="text-decoration: none;color:white" href="{{ route('login') }}" class="material-icons">login</a>
            <span class="tooltiptextlogin">Login</span>
        </div>
        
        @endguest
                </header>
            <!-- <img src="sushis.jpg" alt=""> -->
        </div>
        <center>
            <div class="welcome">
                <center>
                    <h1 style="font-family: 'Benne', serif; font-size:40px">Welcome to Foodex</h1>
                    <p style="margin: 20px 60px;
                    margin-bottom:50px;
                    font-family: Georgia, 'Times New Roman', Times, serif;">
                        "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Saepe officiis praesentium fugit incidunt corporis eveniet, ex molestiae ullam labore rerum. Velit autem fuga doloremque alias ipsa repellat asperiores delectus aperiam!
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto necessitatibus modi cumque quisquam non explicabo suscipit! Ipsa eaque officiis sed rem rerum aspernatur vitae reprehenderit dignissimos! Quae commodi soluta consequatur.
                    "
                    </p>
                    <img src="{{ asset('img/cook.png') }}" class="img-fluid" alt="">
                </center>
            </div>
        </center>
        {{-- MENU --}}
        <div class="Menu" id='menu' >
            <div class="container-menu">
                <div style="opacity: 0.95">
                    <img src="{{ asset('img/rest.jpg') }}" style="border-top-left-radius: 10px;
                    border-top-right-radius: 10px;
                    border-bottom-right-radius: 10px;
                    border-bottom-left-radius: 10px;
                    z-index=1;
                    "  class="img-fluid" alt="">
                </div>
                <div class="centred">MENU</div>
            </div>
                
            <div class="list" style="margin-top:50px">
                <center>
                    <img src="{{ asset('img/sushi.png') }}" style="margin-bottom: 30px" class="img-fluid" alt="">
                </center>
                {{-- <div class="row" style="margin-top:70px;margin-bottom:70px">
                    
                    <div class="col-md-1 ">
                    </div>
                    <div class="col-md-2 items">
                        
                        <center>
                            <img src="{{ asset('img/sushi1.png') }}" style="max-width:170px;margin-bottom:15px" class="img-fluid" alt="">
                            <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                            <p style="max-width:150px; ">
                                Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                            </p>
                        </center>
                        
                        
                    </div>
                    <div class="col-md-2 items">
                        <center>
                            <img src="{{ asset('img/margarita.png') }}" style="max-width:200px;margin-bottom:15px" class="img-fluid" alt="">
                            <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                            <p style="max-width:150px; ">
                                Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                            </p>
                        </center>
                    </div>
                    <div class="col-md-2 items">
                        <center>
                            <img src="{{ asset('img/sushi3.png') }}" style="max-width:165px;margin-bottom:15px" class="img-fluid" alt="">
                            <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                            <p style="max-width:150px; ">
                                Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                            </p>
                        </center>
                    </div>
                    <div class="col-md-2 items">
                        <center>
                            <img src="{{ asset('img/burger4.png') }}" style="max-width:177px;margin-bottom:15px" class="img-fluid" alt="">
                            <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                            <p style="max-width:150px; ">
                                Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                            </p>
                        </center>
                    </div>
                    <div class="col-md-2 items">
                        <center>
                            <img src="{{ asset('img/black-sushi.png') }}" style="max-width:160px;margin-bottom:15px" class="img-fluid" alt="">
                            <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                            <p style="max-width:150px; ">
                                Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                            </p>
                        </center>
                    </div>
                    <div class="col-md-1">

                    </div>
                </div> --}}
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <center>
                            <img src="{{ asset('img/sushi1.png') }}" style="max-width:170px;margin-bottom:15px" class="img-fluid" alt="">
                            <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                            <p style="max-width:150px; ">
                                Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                            </p>
                        </center>
                    </div>
                    <div class="item">
                        
                            <center>
                                <img src="{{ asset('img/margarita.png') }}" style="max-width:200px;margin-bottom:15px" class="img-fluid" alt="">
                                <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                                <p style="max-width:150px; ">
                                    Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                                </p>
                            </center>
                       
                    </div>
                    <div class="item">
                        
                            <center>
                                <img src="{{ asset('img/sushi3.png') }}" style="max-width:165px;margin-bottom:15px" class="img-fluid" alt="">
                                <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                                <p style="max-width:150px; ">
                                    Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                                </p>
                            </center>
                        
                    </div>
                    <div class="item">
                        <center>
                            <img src="{{ asset('img/burger4.png') }}" style="max-width:177px;margin-bottom:15px" class="img-fluid" alt="">
                            <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                            <p style="max-width:150px; ">
                                Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                            </p>
                        </center>
                    </div>
                    <div class="item">
                        <center>
                        <img src="{{ asset('img/black-sushi.png') }}" style="max-width:160px;margin-bottom:15px" class="img-fluid" alt="">
                        <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                        <p style="max-width:150px; ">
                            Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                        </p>
                        </center>
                    </div>
                    <div class="item">
                        <center>
                        <img src="{{ asset('img/black-sushi.png') }}" style="max-width:160px;margin-bottom:15px" class="img-fluid" alt="">
                        <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                        <p style="max-width:150px; ">
                            Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                        </p>
                        </center>
                    </div>
                    <div class="item">
                        <center>
                            <img src="{{ asset('img/burger4.png') }}" style="max-width:177px;margin-bottom:15px" class="img-fluid" alt="">
                            <h3 style="max-width:150px;margin-bottom:15px">Avocado Malki</h3>
                            <p style="max-width:150px; ">
                                Lorem ipsum dolor, sit amet  commodi excepturi in, obcaecati ab delectus maxime.
                            </p>
                        </center>
                    </div>
                </div>
                <div style="margin-top: 50px"><center><a href="{{ route('menu.index') }}" class="btn btn-dark" style="border-radius: 20px;width:300px">View All Menu</a></center></div>
            </div>
        </div>
        {{-- ABOUT --}}
        <div class="about" id="about" >
            <div class="row to_fade_up">
                <div class="col-4"></div>
                <div class="col-md-8">
                    <ul >
                        <li>
                          <a class="bstory">The Story</a>  
                        </li>
                        <li>
                            <a  class="bteam">The Team</a>
                        </li>
                        <li>
                            <a  class="baward">Awards</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="contenu" >
                <div class="story data" style="display: none;">
                    <div class="row to_fade_up" >
                        <div class="col-4 col-md-4" style="margin-top: -100px;" id="imgS"><img  width="100%" height="100%" src="{{ asset('img/chef.jpg') }}" alt=""></div>
                        <div class="col-md-7" id="stori">
                            <table border="0" style="margin-top:30px ; margin-bottom: 30px;" width=100%>
                                <tr align="center" >
                                    <th colspan="5" style="font-size: 60px;
                                    font-weight: bold; color: #EF5D1D;
                                    font-family: 'Stint Ultra Condensed', cursive;"
                                    >A Dream That has Been Cooking for Years</th>
                                </tr>
                                <tr >
                                    <td style="font-family: 'Benne', serif;
                                    font-size: 18px;">
                                        <strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                            Molestiae, animi. Eos quod vero . 
                                            Vero esse mollitia nam, praesentium labore beatae 
                                            optio quam consectetur asperiores quidem corporis 
                                            expedita! Laudantium?</strong>
                                    </td>
                                    <td width=50px></td>
                                    <td style="font-family: 'Benne', serif;
                                    font-size: 18px;">
                                        <strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                            Molestiae, animi. Eos quod vero . 
                                            Vero esse mollitia nam, praesentium labore beatae 
                                            optio quam consectetur asperiores quidem corporis 
                                            expedita! Laudantium?</strong>
                                    </td>
                                    <td width=50px></td>
                                    <td style="font-family: 'Benne', serif;
                                    font-size: 18px;">
                                    
                                        <strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                            Molestiae, animi. Eos quod vero . 
                                            Vero esse mollitia nam, praesentium labore beatae 
                                            optio quam consectetur asperiores quidem corporis 
                                            expedita! Laudantium?</strong>
                                    </td>

                                </tr>
                            </table>
                        </div>
                        
                    </div>
                    <div class="images" style="margin-top: 100px;margin-right: 9%;margin-left: 9%;">
                        <table border="0" style="border-collapse: separate;">
                            {{-- <tr>
                                <td width=20% rowspan="2" valign=top><img src="{{ asset('img/last6-min.jpg') }}"  width="100%" height="390px" alt=""></td>
                                <td width=30% rowspan="3" valign=top ><img src="{{ asset('img/last1-min.jpg') }}"  width="100%"
                                     height="625px" alt=""></td>
                                <td width=50% rowspan="2" height=200px valign=top><img src="{{ asset('img/pizza2-min.jpg') }}" height=390px width=100% alt=""></td>
                            </tr>
                            <tr>
                                
                            </tr>
                            <tr>
                                <td width=20% valign=top><img src="{{ asset('img/burger3.jpeg') }}" width=100% height="234px" alt=""></td>
                                <td width=50% height=200px valign=top>
                                    <img src="{{ asset('img/salade-min.jpeg') }}"  width="49.8%" height="233px" alt="">
                                    <img src="{{ asset('img/last-min.jpg') }}" style="float: right;" width="49.8%" height="233px" alt="">
                                </td>
                            </tr> --}}
                            <tr height=40%>
                                <td width=20%><img src="{{ asset('img/salade-mexicaine.jpg') }}" alt="" width=100%></td>
                                <td width=60% rowspan="2" ><img src="{{ asset('img/burger-min.jpg') }}" alt="" width=100%></td>
                                
                            </tr>
                            <tr height=60%>
                                <td ><img src="{{ asset('img/last2-min.jpeg') }}" alt="" width=100%></td>
                            </tr>
                        </table>
                    </div>
                    <div class="imagesmall" border="1" style="border-color: black" >
                        <table width=80% style="border-collapse: separate; margin-left: 10%; margin-right: 10%">
                            <tr height=40%>
                                <td width=20%><img src="{{ asset('img/burger3.jpeg') }}" alt="" width=100%></td>
                                <td width=60% rowspan="2" ><img src="{{ asset('img/burger-min.jpg') }}" alt="" width=100%></td>
                            </tr>
                            <tr height=60%>
                                <td ><img src="{{ asset('img/last2-min.jpeg') }}" alt="" width=100%></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="team data" style="display: none;">
                    <div class="row" >
                        <div class="col-md-4"  style="margin-left: 60px; margin-top: -80px;" >
                            <table>
                                <tr height=500px align="center">
                                    <td >
                                        <img  width="60%" height="400px" src="{{ asset('img/chef1.png') }}" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign=top>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7" id="team1">
                            <table border="0">
                                <tr valign=center>
                                    <td style="font-size: 50px;font-weight: bold;
                                     padding-bottom: 30px; color: #EF5D1D;
                                     font-family: 'Stint Ultra Condensed', cursive;">
                                        Chef Hamza
                                    </td>
                                </tr>
                                <tr height="220px">
                                    <td style="padding-left: 20px;font-size: 20px;
                                    font-family: 'Benne', serif;" valign="center">
                                        <strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam labore dolores nesciunt ipsam praesentium minus! Quia nostrum, vitae nesciunt magni, sequi suscipit ea dolorem consectetur, officiis aspernatur minus doloribus hic?
                                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit distinctio ab alias ipsum earum ut itaque explicabo ex quibusdam mollitia, perferendis ratione tempore aliquid id eius dolore ipsam fuga provident!
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis incidunt alias voluptatibus quos dicta rerum, libero iure ex, laudantium nisi corrupti ratione earum iste dolore quam, facere quaerat? Nobis, velit!</strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-1"></div>
                        <div class="col-md-7 " id="team" >
                            <table border="0" width=100% >
                                <tr valign=center align="right">
                                    <td style="font-size: 50px;font-weight: bold;
                                     padding-bottom: 30px; color: #EF5D1D;
                                     font-family: 'Stint Ultra Condensed', cursive;">
                                        Chef Hamza
                                    </td>
                                </tr>
                                <tr height="220px" align="right">
                                    <td style="padding-left: 20px;font-size: 20px;
                                    font-family: 'Benne', serif;" valign="center">
                                        <strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam labore dolores nesciunt ipsam praesentium minus! Quia nostrum, vitae nesciunt magni, sequi suscipit ea dolorem consectetur, officiis aspernatur minus doloribus hic?
                                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit distinctio ab alias ipsum earum ut itaque explicabo ex quibusdam mollitia, perferendis ratione tempore aliquid id eius dolore ipsam fuga provident!
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis incidunt alias voluptatibus quos dicta rerum, libero iure ex, laudantium nisi corrupti ratione earum iste dolore quam, facere quaerat? Nobis, velit!</strong>
                                    </td>
                                </tr>
                            </table>
                    </div>
                    <div class="col-md-4" style="margin-top: -80px;" >
                        <table>
                            <tr height=500px align="center">
                                <td >
                                    <img  width="60%" height="400px" src="{{ asset('img/chef1.png') }}" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign=top>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    </div>
                    
                </div>
            </div>         
        </div>
        <div class="before-foot" >
            <center>
                <img src="{{ asset('img/dining-table.png') }}"  alt="">
                <p style="margin-top: 5px;font-size: 40px; font-family: 'Stint Ultra Condensed', cursive;">
                    "Good painting is like good cooking-it can be tasted but not explained."
                </p>
                <div style="margin-bottom: 30px;">
                    <span class="fa fa-star check"></span>
                    <span class="fa fa-star check"></span>
                    <span class="fa fa-star check"></span>
                    <span class="fa fa-star check"></span>
                    <span class="fa fa-star"></span>
                    <span>-</span>
                    <span style="font-size: small;">FOODEX</span>
                </div>
                <p style="max-width: 60%;margin-bottom: 40px;">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis saepe, molestiae aspernatur distinctio adipisci animi architecto veniam laboriosam omnis possimus qui aliquid repellat culpa libero, quas nihil, explicabo magnam molestias!
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae autem nulla ad minus incidunt eligendi nam unde voluptatibus hic rem similique ullam quo obcaecati libero, ratione doloremque, deserunt sed iste?
                </p>
                <div class="row last" style="font-family: 'Stint Ultra Condensed', cursive" >
                    <div class="col-md-4" style="background-color: orange; border-top-left-radius: 20px;
                    border-bottom-left-radius: 20px;">
                        <h5 style="margin-top:10px "><b>FOODEX</b></h5>
                    </div>
                    <div class="col-md-4">
                        <h5 style="margin-top:10px "><i class="material-icons" style="font-size:25px">restaurant</i></h5>
                    </div>
                    <div class="col-md-4" style="background-color: orange; border-top-right-radius: 20px;
                    border-bottom-right-radius: 20px;">
                        <h5 style="margin-top:10px "><b>RESTAURANT</b></h5>
                    </div>

                </div>
            </center>
           

        </div>
    </div>
<footer>
    <div class="tb">
        <table class="tab" width=100%  >
            <tr >
                <th style="text-align: center;">About</th>
                <th style="text-align:center ;">Get News & Offers</th>
                <th style="text-align: center;">Contacts</th>
            </tr>
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
                <td><pre>  </pre></td>
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
       $(function() {
            $(".nv").on('click',function() {
                $("#Modal").modal('show')
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
   </script>
</body>
</html>