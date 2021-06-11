@extends('layouts.app', ['activePage' => 'fournisseuredit', 'titlePage' => __('Modifier fournisseur')])
@section('content')
    <div class="content">
      <div class="col-md-10 mx-auto">
        <div class="card">
          <div class="card-header card-header-primary">
            
              <h4 class="card-title "> <b>Fournisseurs</b> 
                </h4>
              <p class="card-category"> Modifier des Fournisseurs</p>
          </div>
          <div class="card-body">
        <form action="{{route('fournisseur.update' ,$fournisseur->id)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" name="nom" aria-describedby="nom" placeholder="Enter nom" value="{{ $fournisseur->nom}}">
            </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $fournisseur->email}}">
              </div>
              <div class="form-group">
                <label for="tele">N° tele</label>
                <input type="text" class="form-control" name="tele" aria-describedby="tele" placeholder="Enter tele" value="{{ $fournisseur->tele}}">
              </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Adresse</label>
              <input type="text" class="form-control" name="adresse" placeholder="adresse" value="{{ $fournisseur->adresse}}">
            </div>
            
            <button type="submit" class="btn btn-primary">Modifier</button>
          </form>
    </div>
      </div>
    </div>
  </div>
@endsection