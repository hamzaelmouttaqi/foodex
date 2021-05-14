@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route("clients.store") }}" method="post">
            @csrf
            <div class="form-group">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" name="nom" placeholder="Enter nom">
            </div>
            <div class="form-group">
              <label for="Prenom">Prenom</label>
              <input type="text" class="form-control" name="Prenom" placeholder="Prenom">
            </div>
            <div class="form-group">
                <label for="date_de_naissance">Date De Naissance</label>
                <input type="date" class="form-control" name="date_de_naissance" placeholder="0000-00-00">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="tele">Numero Tele</label>
                <input type="text" class="form-control" name="tele" placeholder="Numero">
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" name="adresse" placeholder="Adresse">
            </div>
            <div class="form-group">
                <label for="code_postal">Code Postal</label>
                <input type="number" class="form-control" name="code_postal" placeholder="Code Postal">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </form>
    </div>
@endsection