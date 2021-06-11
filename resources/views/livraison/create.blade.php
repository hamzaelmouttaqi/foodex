@extends('layouts.app', ['activePage' => 'Livraison', 'titlePage' => __('Ajouter Ville')])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title "> <b>Ajouter ville</b></h4>
                </div>
                <div class="card-body">
                    <form action="{{ route("livraison.store") }}" method="post" >
                        @csrf
                        <br><div class="form-group">
                          <label for="nom" style="color: black"><strong>Nom ville</strong></label>
                          <input type="text" class="form-control" name="ville" placeholder="Enter nom ville">
                        </div><br>
                        <div class="form-group">
                            <label for="code_postal" style="color: black"><strong>Code Postal</strong></label>
                            <input type="number" class="form-control" name="code_postal" placeholder="Enter code postal">
                        </div> <br>
                        <div class="form-group">
                            <label for="prix" style="color: black"><strong>Prix</strong></label>
                            <input type="number" class="form-control" name="prix" placeholder="0Dhs">
                        </div><br>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                      </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection