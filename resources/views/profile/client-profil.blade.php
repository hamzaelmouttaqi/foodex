<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset("font/style.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('font/css/bootstrap.css') }}">
    <script src="{{ asset('font/js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('font/js/popper.js') }}"></script>
    <script src="{{ asset("font/style.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js" integrity="sha512-ZKNVEa7gi0Dz4Rq9jXcySgcPiK+5f01CqW+ZoKLLKr9VMXuCsw3RjWiv8ZpIOa0hxO79np7Ec8DDWALM0bDOaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
    <title>Document</title>
    @livewireStyles
</head>
<body>
            <header class="head" style="background-color: orange">
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
       
    
    
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row gutters">
            <div class=" col-12" >
            <div class="card h-100" style="border: red;">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                                <center>
                                    <div class="user-avatar">
                                      <div class="circle">
                                        <!-- User Profile Image -->
                                        <img class="profile-pic" src="{{ asset('uploads/profil/default.png')}}">
                                 
                                        <!-- Default Image -->
                                        <!-- <i class="fa fa-user fa-5x"></i> -->
                                      </div>
                                      <div class="p-image">
                                        <i class="fas fa-camera upload-button"></i>
                                         <input data-id="{{ $profile->id }}" class="file-upload" id="file-up" name="myfile" type="file" accept="image/*"/>
                                      </div>
                                    </div>
                                </center>
                            <h5 class="user-name"><b><pre>{{ $profile->nom }} {{ $profile->Prenom }}</pre></b></h5>
                            <h6 class="user-email">{{ $profile->email }}</h6>
                        </div>
                        
                    </div>
                </div>
            </div>
            </div>
            <div class=" col-12">
            <div class="card h-100" >
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fullName" style="font-weight: bold">Nom</label>
                                <input type="text" class="form-control" name="nom" id="fullName" value="{{ $profile->nom }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fullName" style="font-weight: bold">Prenom</label>
                                <input type="text" class="form-control" name="prenom" id="fullName" value="{{ $profile->Prenom }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="eMail" style="font-weight: bold">Email</label>
                                <input type="email" class="form-control" name="email" id="eMail" value="{{ $profile->email }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone" style="font-weight: bold">N° télé</label>
                                <input type="text" class="form-control" name="tele" id="phone" value="{{ $profile->tele }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="website" style="font-weight: bold">Adresse</label>
                                <input type="url" class="form-control" name="adresse" id="adresse" value="{{ $profile->adresse }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="website" style="font-weight: bold">Code Postal</label>
                                <input type="url" class="form-control" name="codePostal" id="codePostal" value="{{ $profile->code_postal }}">
                            </div>
                        </div>
                    </div>
                    <div class="row gutters" style="margin-top: 1%">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin-left: 80%;">
                            <div class="text-right">
                                <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                                <button type="button" id="submit" name="submit" class="btn" style="background-color: orange; color: white;">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </form>
        </div>
        @livewireScripts
        <script>
        //     $(function() {
        //     $(".chng").on('change',function() {
        //         $('.profile-pic').css('background-image', 'url(' + $('.chng').val() + ')');
        //     })
        // })
        $(document).ready(function() {

    
var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(".file-upload").on('change', function(){

        var filew = $('#file-up')[0].files[0];
        var fd =new FormData();
        //   var id =$(this).data('id');
        fd.append('file',filew)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          $.ajax({    
              type: "POST",
              cache: false,
              processData: false,
              contentType: 'multipart/form-data',
              url: "/changeImage",
              data: fd,
              success: function(data){
                console.log(data.success);
              }
          });
    readURL(this);
});

$(".upload-button").on('click', function() {
   $(".file-upload").click();
});
});
        </script>
</body>
</html>