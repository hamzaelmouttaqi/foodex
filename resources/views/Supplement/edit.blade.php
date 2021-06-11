@extends('layouts.app', ['activePage' => 'supplement', 'titlePage' => __('Supplement')])

 
@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> <b>Supplement</b>
              </h4>
            <p class="card-category">Modifier un supplement</p>
            
          </div>
        <div class="card-body">
        <form action="{{ route("supplement.update" ,$supplement->id) }}" method="post">
            @csrf
            @method("PUT")
            <div class="form-group">
              <label for="titre">nom supplement</label>
              <input type="text" class="form-control" name="titre" placeholder="Enter titre" value="{{ $supplement->titre}}">
            </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="number" class="form-control" name="prix" placeholder="Enter prix" value="{{ $supplement->prix }}">
            </div>
            <label for="categorie_id"><b> CHOISIR CATEGORIE</b></label><br>
              @foreach ($catsupp as $catsupp)
                  <input type="radio" name="categorie_id" value="{{ $catsupp->id }}">{{ $catsupp->title }}<br>
                  @endforeach
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="image" value="{{ $supplement->image}}">
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>  
          </form>
        </div>
      </div>
    </div>
    </div>
@endsection