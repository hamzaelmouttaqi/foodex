@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route("categorie.store") }}" method="post" >
            @csrf
            <div class="form-group">
              <label for="nomCat">Nom de Categorie</label>
              <input type="text" class="form-control" name="nomCat" placeholder="Enter le nom">
            </div>
                <fieldset>
                    <label>Status:</label><br>
                    <input type="radio" name="status" value="1">Active<br>
                    <input type="radio" name="status" value="0">Desactiver<br>
                </fieldset>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </form>
    </div>
@endsection