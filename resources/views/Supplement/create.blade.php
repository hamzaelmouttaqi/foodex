@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route("supplement.store") }}" method="post" >
            @csrf
            <div class="form-group">
              <label for="titre">Nom de supplement</label>
              <input type="text" class="form-control" name="titre" placeholder="Enter le nom du supplement">
            </div>
              <input type="number" name="prix">
                <fieldset>
                    <label>Status:</label><br>
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
@endsection