@extends('layouts.app', ['activePage' => 'categorie', 'titlePage' => __('categorie')])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                      <h4 class="card-title "> <b>Categories</b>
                        </h4>
                      <p class="card-category">Modifier</p>
                      
                    </div>
               <div class="card-body">

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
            </div>
            </div>
        </div>
    </div>
@endsection