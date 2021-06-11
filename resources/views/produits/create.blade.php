@extends('layouts.app', ['activePage' => 'Produit', 'titlePage' => __('Ajouter Produit')])

@section('content')
    <div class="content">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title "> <b>Produits</b>
                  </h4>
                <p class="card-category">Ajouter un produit</p>
                
              </div>
            <div class="card-body">
                <form action="{{ route("produit.store") }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="titre">Nom de Produit</label>
                      <input type="text" class="form-control" name="titre" placeholder="Enter Titre">
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                  </form>
            </div>
        </div>
    </div>
    </div>
@endsection