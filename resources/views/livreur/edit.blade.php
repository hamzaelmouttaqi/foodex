@extends('layouts.app')
 
@section('content')
    <div class="container">
        <form action="{{ route("supplement.update" ,$supplement->id) }}" method="post">
            @csrf
            @method("PUT")
            <div class="form-group">
              <label for="titre">nom supplement</label>
              <input type="text" class="form-control" name="titre" placeholder="Enter titre" value="{{ $supplement->titre}}">
            </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="number" class="form-control" name="prix" placeholder="Enter prix">
            </div>
            <label for="categorie_id"><b> CHOISIR CATEGORIE</b></label><br>
              @foreach ($catsupp as $catsupp)
                  <input type="radio" name="categorie_id" value="{{ $catsupp->id }}">{{ $catsupp->title }}<br>
                  @endforeach
            <button type="submit" class="btn btn-primary">Modifier</button>  
          </form>
    </div>
@endsection