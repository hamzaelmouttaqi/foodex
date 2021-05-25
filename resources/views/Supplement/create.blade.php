@extends('layouts.app', ['activePage' => 'supplement', 'titlePage' => __('supplement')])

@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> <b>Supplement</b>
              </h4>
            <p class="card-category">Ajouter un supplement</p>
            
          </div>
        <div class="card-body">
        <form action="{{ route("supplement.store") }}" method="post" >
            @csrf
            <div class="form-group">
              <label for="titre"><b>Nom de supplement</b> </label>
              <input type="text" class="form-control" name="titre" placeholder="Enter le nom du supplement">
            </div>
              <input type="number" name="prix">
                <fieldset>
                    <label><b>Status:</b></label><br>
                    <input type="radio" name="status" value="1">Active<br>
                    <input type="radio" name="status" value="0">Desactiver<br>
                </fieldset>
                <fieldset>
                  <label for="categorie_id"><b> CHOISIR CATEGORIE</b></label><br>
                  @foreach ($catsupp as $catsupp)
                  <input type="radio" name="categorie_id" value="{{ $catsupp->id }}">{{ $catsupp->title }}<br>
                  @endforeach
    
                </fieldset>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </form>
        </div>
        </div>
    </div>
    </div>
@endsection