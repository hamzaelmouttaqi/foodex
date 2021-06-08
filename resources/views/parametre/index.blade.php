@extends('layouts.app', ['activePage' => 'Parametre', 'titlePage' => __('Parametre')])

@section('content')
    <div class="content">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title "> <b>parametres</b>
                  </h4>
                <p class="card-category">parametre </p>
                
              </div>
         <div class="card-body">  
           
                    @foreach ($parametres as $parametre)
                    <form action="{{ route("parametre.update",$parametre->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" name="titre" value="{{ $parametre->titre}}">
                        </div>
                        <div class="form-group">
                        <label for="nom">Nom Magasin</label>
                        <input type="text" class="form-control" name="nom_magasin" value="{{ $parametre->nom_magasin}}">
                        </div>
                        <img src="{{ asset('uploads/parametres/icon/'.$parametre->icon ) }}" alt="">
                            <label for="Icon">Icon</label>
                            <input type="file" class="form-control" id="customFile" name="icon" />
                        
                            <img src="{{ asset('uploads/parametres/logo/'.$parametre->logo ) }}" alt="">
                            <label for="Icon">logo</label>
                            <input type="file" class="form-control" name="logo" >
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $parametre->email }}">
                        </div>
                        <div class="form-group">
                            <label for="tele">Numero Tele</label>
                            <input type="text" class="form-control" name="tele" placeholder="Numero" value="{{ $parametre->tele }}">
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" name="adresse" placeholder="Adresse" value="{{ $parametre->adresse }}">
                        </div>
                        <div class="form-group">
                            <label for="footer">Text footer</label>
                            <input type="text" class="form-control" name="text_footer" value="{{ $parametre->text_footer }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                @endforeach
            
        </div>
        </div>
    </div>
    </div>
@endsection