@extends('layouts.app', ['activePage' => 'composants', 'titlePage' => __('composants')])

@section('content')
    <div class="content">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title "> <b>Composants</b>
                  </h4>
                <p class="card-category">Ajouter un composant</p>
                
              </div>
            <div class="card-body">
              <form action="{{ route("composants.store") }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="nomComposant"><strong>NOM DE COMPOSANTS</strong></label>
                    <input type="text" class="form-control" name="nomComposant" placeholder="Enter nomComposant">
                  </div>
                  <div class="form-group">
                    <label for="nomComposant"><strong>PRIX</strong></label>
                    <input type="number" name="prix">             
                  </div>
                  <label class="form-label" for="customFile">Default file input example</label>
                  <input type="file" class="form-control" id="customFile" name="image"/>
                  <fieldset>
                    <label for="Category_id"><b> CHOISIR CATEGORIE</b></label><br>
                    @foreach ($CatCom as $CatCom)
                    <input type="radio" name="Category_id" value="{{ $CatCom->id }}">{{ $CatCom->title }}<br>
                    @endforeach
                  </fieldset>
                  <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
            </div>
          </div>
      </div>
    </div>
@endsection