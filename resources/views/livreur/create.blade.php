@extends('layouts.app' , ['activePage' => 'Livreur', 'titlePage' => __('Ajouter Livreur')])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title "> <b>Ajouter livreurs</b></h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route("livreur.store") }}" method="post" >
                            @csrf
                            <div class="form-group">
                              <label for="nom">Nom livreur</label>
                              <input type="text" class="form-control" name="nom" placeholder="Enter nom">
                            </div>
                            <div class="form-group">
                                <label for="codePostal">Code Postal</label>
                                
                                <select name="code_postal" id="">
                                    <option value="" disabled selected>Code Postal</option>
                                    @foreach ($livraisons as $liv)
                                        <option value="{{$liv->code_postal}}">{{$liv->code_postal}}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <fieldset>
                                <label for="status">status</label><br>
                                <input type="radio" name="status" value="1">En service<br>
                                <input type="radio" name="status" value="0">Hors service <br>
                              </fieldset>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                          </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection