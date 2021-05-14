@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route("categorie.update",$categorie->id) }}" method="post">
            @csrf
            @method("PUT")
            <div class="form-group">
              <label for="nomCat">titre</label>
              <input type="text" class="form-control" name="nomCat" placeholder="Enter Nom" value="{{ $categorie->nomCat }}">
            </div>
           
                <fieldset>
                    <label>Status:</label><br>
                    <input type="radio" name="status" value="1">Active<br>
                    <input type="radio" name="status" value="0">Desactiver<br>
                </fieldset>
            
            <button type="submit" class="btn btn-primary">Modifier</button>
          </form>
    </div>
@endsection