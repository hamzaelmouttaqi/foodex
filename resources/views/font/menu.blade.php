<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('font/menu.css') }}">
    <script src="{{ asset('font/menu.js') }}" language="JavaScript" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>FOODEX</title>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
</head>
<body>
    {{-- MODEL --}}
    <div class="row">
        <div class="col-md-12">
          <form action="" method="POST" class="form-vertical">
            @csrf
            <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-body">
                    <table width=100% border="0" style="font-family: 'Lora', serif;">
                        <tr width=100%>
                            <th colspan="2" style="padding-left: 20px;padding-bottom:20px">
                               <h4>BURGER</h4>
                            </th>
                            <td align=right valign=top>
                                   <i class="fas fa-times-circle fa-lg" style="cursor: pointer" data-bs-dismiss="modal" 
                                   aria-label="Close">
                                    </i>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="titre" style="padding-left: 50px;padding-bottom:10px">
                                <h4>
                                    Size :
                                </h4>
                            </td>
                        </tr>
                        <tr height=30px>
                           <td align="center" style="padding-left: 50px;">
                             <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                           </td>
                            <td style="padding-left: 50px;">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Default radio
                                </label>
                            </td>
                            <td>
                                30 DH
                            </td>
                        </tr>
                        <tr height=30px>
                            <td align="center" style="padding-left: 50px;">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                             <td style="padding-left: 50px;">
                                 <label class="form-check-label" for="flexRadioDefault1">
                                     Default radio
                                 </label>
                             </td>
                             <td>
                                 30 DH
                             </td>
                         </tr>
                         <tr height=30px>
                            <td align="center" style="padding-left: 50px;">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                             <td style="padding-left: 50px;">
                                 <label class="form-check-label" for="flexRadioDefault1">
                                     Default radio
                                 </label>
                             </td>
                             <td>
                                 30 DH
                             </td>
                         </tr>
                         <tr >
                            <td colspan="3" class="titre" style="padding-left: 50px;padding-top:20px">
                                <h4>
                                    COMPOSANTS : 
                                </h4>
                            </td>
                        </tr>
                        <tr height=20px></tr>
                        <tr>
                            <td colspan="3" style="padding-left: 70px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-success">
                                            <p class="title "> 
                                                <input type="checkbox" role="1.50" title="Sauce Chili Thai" 
                                                name="addons" value="43" id="addons_43" checked>
                                                <label for="addons_43">Sauce Chili Tha</label>i
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-success">
                                            <p class="title "> 
                                                <input type="checkbox" role="1.50" title="Sauce Chili Thai" 
                                                name="addons" value="43" id="addons_43" checked>
                                                <label for="addons_43">Sauce Chili Tha</label>i
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-success">
                                            <p class="title "> 
                                                <input type="checkbox" role="1.50" title="Sauce Chili Thai" 
                                                name="addons" value="43" id="addons_43" checked>
                                                <label for="addons_43">Sauce Chili Tha</label>i
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-success">
                                            <p class="title "> 
                                                <input type="checkbox" role="1.50" title="Sauce Chili Thai" 
                                                name="addons" value="43" id="addons_43" checked>
                                                <label for="addons_43">Sauce Chili Tha</label>i
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-success">
                                            <p class="title "> 
                                                <input type="checkbox" role="1.50" title="Sauce Chili Thai" 
                                                name="addons" value="43" id="addons_43" checked>
                                                <label for="addons_43">Sauce Chili Tha</label>i
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-success">
                                            <p class="title "> 
                                                <input type="checkbox" role="1.50" title="Sauce Chili Thai" 
                                                name="addons" value="43" id="addons_43" checked>
                                                <label for="addons_43">Sauce Chili Tha</label>i
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-success">
                                            <p class="title "> 
                                                <input type="checkbox" role="1.50" title="Sauce Chili Thai" 
                                                name="addons" value="43" id="addons_43" checked>
                                                <label for="addons_43">Sauce Chili Tha</label>i
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-success">
                                            <p class="title "> 
                                                <input type="checkbox" role="1.50" title="Sauce Chili Thai" 
                                                name="addons" value="43" id="addons_43" checked>
                                                <label for="addons_43">Sauce Chili Tha</label>i
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-success">
                                            <p class="title "> 
                                                <input type="checkbox" role="1.50" title="Sauce Chili Thai" 
                                                name="addons" value="43" id="addons_43" checked>
                                                <label for="addons_43">Sauce Chili Tha</label>i
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                                
                            
                        </tr>
                        <tr>
                            <td colspan="3" class="titre" style="padding-left: 50px;padding-bottom:30px">
                                <h6>
                                    SPECIAL REQUEST ? 
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center">
                                <a style="text-decoration: none; color:rgb(255, 136, 0)" 
                                data-bs-toggle="collapse" href="#ajoute" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                    <i class="fas fa-plus"></i>ADD YOUR FAVOURITE SUPPLEMENT AND COMPOSANTS
                                </a>
                                <div class="collapse multi-collapse" id="ajoute">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a class="composant btn" data-id="" 
                                            style="color: black;font-weight: 900;
                                            background-color: #ffff;box-shadow: none"
                                              for="composants" >Composants Payants</a>
                                             <div id="comp_" style="display: none">
                                               <table width="100%">
                                                   <tr align=center>
                                                     <td>
                                                       <input type="checkbox" name="ingredient_[]" value="" >
                                                     </td>
                                                     <td>
                                                       Titre
                                                     </td>
                                                     <td>
                                                       20 DH
                                                     </td>
                                                     <td>
                                                       <input type="number" min="1" max="5" value="1" name="quantite_">
                                                     </td>
                                                   </tr>
                                               </table>   
                                           </div>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="supplement btn" data-id="" style="background-color: #ffff;box-shadow: none;
                                                color: black;font-weight: 900" for="supplement"><b>Supplements</b></a>
                                              <div id="supp_" style="display: none">
                                                <table width="100%" >
                                                  <tr align=right>
                                                    <td>
                                                      <input type="checkbox" name="supplement_[]" 
                                                      value="">
                                                    </td>
                                                    <td>
                                                      titre
                                                    </td>
                                                    <td>
                                                      20 DH
                                                    </td>  
                                                 </tr>
                                                </table>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr height=20px></tr>
                        <tr height=20px >
                            <td colspan="2" class="titre" style="padding-left: 90px">
                                <h5>
                                    QUANTITE
                                </h5>
                            </td>
                            <td align="center" style="padding-top: 30px">
                                <fieldset>
                                    <input type="button" value="-" class="decrease" />
                                    <input type="text" id="three-max" value="0" />
                                    <input type="button" value="+" class="increase" />
                                </fieldset>
                            </td>
                        </tr>
                        <tr height=40px>
                            <td colspan="3" align=center>
                                <a href="" class="btn btn-warning">
                                    <i class="fas fa-plus"></i>
                                    ADD TO MY ORDER
                                </a>
                            </td>
                           
                        </tr>
                        
                    </table>
                    
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>

    {{-- FIN MODEL --}}
    <header class="head">
        <a href="#" class="logo"><img src="{{ asset('img/foodex_noir.png') }}" alt=""></a>
        <!-- <div id="menu-bar" class="fas fa-bars"></div> -->
        <nav class="navbar">
            <a href="#home">HOME</a>
            <a href="#about">ABOUT</a>
            <a href="#menu">MENU</a>
            <a href="#review">REVIEW</a>
            <a href="#contact">CONTACT</a>
        </nav>
        <div class="left">
            <a href="#"><i class="material-icons">shopping_bag</i></a>
            <a href="#"><i class="material-icons">search</i></a>
        </div>
    </header>
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="products">
                    <h4>Products</h4>
                    <nav class="productNav">
                        <ul>
                            <li class="nav-item">
                                <div class="lien" id="pizza">
                                    <div class="car" style="display: none !important;"></div>
                                    <a  href="#Pizza">Pizza</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="lien"  id="burger">
                                    <div class="car" style="display: none !important;"></div>
                                    <a href="#burger">Burger</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="lien" id="sushi">
                                    <div class="car" style="display: none !important;"></div>
                                    <a href="#sushi">Sushi</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="lien" id="salade">
                                    <div class="car" style="display: none !important;"></div>
                                    <a href="#salade">Salade</a>
                                </div>
                            </li>
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
                        <div class="col-md-4" style="margin-bottom: 20px">
                            <table border="0" width=200px height=300px >
                                <tr valign='top' height=180px>
                                    <td colspan="2" align="center">
                                       <img src="{{ asset('img/burger3.jpeg') }}"  width="180px" alt="" style="border-radius: 10px;
                                       box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <b>Burger</b>
                                    </td>
                                    <td align="center">
                                        <b>30dh</b>
                                    </td>
                                </tr>
                                <tr valign='top'>
                                    <td align="center" colspan="2">
                                        
                                        <button data-bs-target="#Modal" data-bs-toggle="modal" 
                                        class="btn btn-outline-primary">Add To Card</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px">
                            <table border="0" width=200px height=300px >
                                <tr valign='top' height=180px>
                                    <td colspan="2" align="center">
                                       <img src="{{ asset('img/burger3.jpeg') }}"  width="180px" alt="" style="border-radius: 10px;
                                       box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <b>Burger</b>
                                    </td>
                                    <td align="center">
                                        <b>30dh</b>
                                    </td>
                                </tr>
                                <tr valign='top'>
                                    <td align="center" colspan="2">
                                        <button class="btn btn-outline-primary">Add To Card</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px">
                            <table border="0" width=200px height=300px >
                                <tr valign='top' height=180px>
                                    <td colspan="2" align="center">
                                       <img src="{{ asset('img/burger3.jpeg') }}"  width="180px" alt="" style="border-radius: 10px;
                                       box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <b>Burger</b>
                                    </td>
                                    <td align="center">
                                        <b>30dh</b>
                                    </td>
                                </tr>
                                <tr valign='top'>
                                    <td align="center" colspan="2">
                                        <button class="btn btn-outline-primary">Add To Card</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px">
                            <table border="0" width=200px height=300px >
                                <tr valign='top' height=180px>
                                    <td colspan="2" align="center">
                                       <img src="{{ asset('img/burger3.jpeg') }}"  width="180px" alt="" style="border-radius: 10px;
                                       box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <b>Burger</b>
                                    </td>
                                    <td align="center">
                                        <b>30dh</b>
                                    </td>
                                </tr>
                                <tr valign='top'>
                                    <td align="center" colspan="2">
                                        <button class="btn btn-outline-primary">Add To Card</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px">
                            <table border="0" width=200px height=300px >
                                <tr valign='top' height=180px>
                                    <td colspan="2" align="center">
                                       <img src="{{ asset('img/burger3.jpeg') }}"  width="180px" alt="" style="border-radius: 10px;
                                       box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <b>Burger</b>
                                    </td>
                                    <td align="center">
                                        <b>30dh</b>
                                    </td>
                                </tr>
                                <tr valign='top'>
                                    <td align="center" colspan="2">
                                        <button class="btn btn-outline-primary">Add To Card</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px">
                            <table border="0" width=200px height=300px >
                                <tr valign='top' height=180px>
                                    <td colspan="2" align="center">
                                       <img src="{{ asset('img/burger3.jpeg') }}"  width="180px" alt="" style="border-radius: 10px;
                                       box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <b>Burger</b>
                                    </td>
                                    <td align="center">
                                        <b>30dh</b>
                                    </td>
                                </tr>
                                <tr valign='top'>
                                    <td align="center" colspan="2">
                                        <button class="btn btn-outline-primary">Add To Card</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        
                        
                        
                        
                        
                    </div>
                </center>
            </div>
        
        <div class="col-md-3">
        <div class="order">
            <table class="tab1">
                <tr>
                    <td align="left" style="color: white; font-size: 30px ;">My order</td>
                    <td align="right" style="font-size: 12px;">(O items)</td>
                </tr>
                <tr height=250px>
                    <td colspan="2" align="center" valign="center"><i class="material-icons-outlined" 
                        style="font-size: 120px;">shopping_bag</i></td>
                </tr>
                
                <tr style="border-bottom: 1px black;">
                    <td colspan="2" valign="top" style="text-align: center; font-size: small;">Browse our menu and start adding items to your order</td>
                </tr>
                
                <tr style="height: 100px;">
                    <td colspan="2" align="center">
                        <button class="btn btn-primary">Order Now</button>
                    </td>
                </tr>
                
            </table>
        </div>
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
    
        
    
</body>
</html>