@extends('layouts.app', ['activePage' => 'Livraison', 'titlePage' => __('Modifier Ville')])

@section('content')
    {{-- <div class="container">
        <form action="{{ route("livraison.update" ,$livraison->code_postal) }}" method="post" >
            @csrf
            @method("PUT")
            <div class="form-group">
              <label for="nomlivraison">Ville</label>
              <input type="text" class="form-control" name="ville" placeholder="Enter titre" value="{{ $livraison->ville}}">
            </div>
            <div class="form-group">
                <label for="codePstal">Code postal</label>
                <input type="number" class="form-control" name="code_postal" placeholder="Enter titre" value="{{ $livraison->code_postal}}">
              </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="number" class="form-control" name="prix" placeholder="Enter prix">
            </div>
            
            
            
            <button type="submit" class="btn btn-primary">Modifier</button> 
          </form>
    </div> --}}
    <div class="content">
        <div class="row">
            <div class="col-md-2">
    
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title "> <b>Modifier ville</b></h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route("livraison.update" ,$livraison->code_postal) }}" method="post" >
                            @csrf
                            @method("PUT")
                            <br><div class="form-group">
                              <label for="nomlivraison"><strong>Ville</strong></label>
                              <input type="text" class="form-control" name="ville" placeholder="Enter titre" value="{{ $livraison->ville}}">
                            </div>
                            
                            <br><div class="form-group">
                                <label for="prix"><strong>Prix</strong></label>
                                <input type="number" class="form-control" name="prix" placeholder="Enter prix">
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button> 
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection