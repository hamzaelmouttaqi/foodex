@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route("clients.update",$clients->id) }}" method="post">
            @csrf
            @method("PUT")
            <div class="form-group">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" name="nom" placeholder="Enter nom" value="{{ $clients->nom }}">
            </div>
            <div class="form-group">
              <label for="Prenom">Prenom</label>
              <input type="text" class="form-control" name="Prenom" placeholder="Prenom" value="{{ $clients->Prenom }}">
            </div>
            <div class="form-group">
                <label for="date_de_naissance">Date De Naissance</label>
                <input type="date" class="form-control" name="date_de_naissance" value="{{ $clients->date_de_naissance }}" >
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $clients->email }}">
            </div>
            <div class="form-group">
                <label for="tele">Numero Tele</label>
                <input type="text" class="form-control" name="tele" placeholder="Numero" value="{{ $clients->tele }}">
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" name="adresse" placeholder="Adresse" value="{{ $clients->adresse }}">
            </div>
            <div class="form-group">
                <label for="code_postal">Code Postal</label>
                <input type="number" class="form-control" name="code_postal" placeholder="Code Postal" value="{{ $clients->code_postal }}">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
          </form>
    </div>
@endsection