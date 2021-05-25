@extends('layouts.app', ['activePage' => 'composants', 'titlePage' => __('composants')])
@section('content')
@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> <b>Composants</b>
              </h4>
            <p class="card-category">Modifier un composant</p>
            
          </div>
        <div class="card-body">
        <form action="{{ route("composants.update",$composant->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-group">
              <label for="nomComposant"><strong>NOM COMPOSANTS</strong></label>
              <input type="text" class="form-control" name="nomComposant" placeholder="Enter nomComposant" value="{{ $composant->nomComposant }}">
            </div>
            <div class="form-group">
              <label for="nomComposant"><STRong>PRIX</STRong></label>
              <input type="number" name="prix" value="{{ $composant->prix }}"> 
           </div>
            
            <div class="form-group">
              <label for="categorie"><strong>CATEGORIE</strong></label>
              <input type="text" class="form-control" name="categorie" placeholder="categorie" value="{{ $composant->categorie }}">
            </div>
            <label class="form-label" for="customFile"><STRong>CHOISIR VOTRE IMAGE</STRong></label>
                  <input type="file" class="form-control" id="customFile" name="image"/>
              @foreach ($CatCom as $CatCom)
              <input type="checkbox" name="Category_id" value="{{ $CatCom->id }}">{{ $CatCom->title }}<br>
              @endforeach
            <button type="submit" class="btn btn-primary">Modifier</button>
          </form>
        </div>
        </div>
    </div>
  </div>
    </div>
@endsection