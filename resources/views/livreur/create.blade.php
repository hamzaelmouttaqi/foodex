@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route("livreur.store") }}" method="post" >
            @csrf
            <div class="form-group">
              <label for="nom">Nom livreur</label>
              <input type="text" class="form-control" name="nom" placeholder="Enter nom">
            </div>
            
                <select name="code_postal" class="form-select">
                  <option value="" selected disabled>Choisir la ville</option>
                  @foreach ($livraisons as $livraison)
                      <option value="{{ $livraison->code_postal }}">{{ $livraison->ville }}</option>
                  @endforeach
                </select>
              
              <fieldset>
                  <label for="status">status</label><br>
                  <input type="radio" name="status" value="1">En service<br>
                  <input type="radio" name="status" value="0">Hors service <br>
                </fieldset>
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </form> 
      </div>
  @endsection