@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route("composants.store") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="nomComposant">nom de Composant</label>
              <input type="text" class="form-control" name="nomComposant" placeholder="Enter nomComposant">
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
            <fieldset>
              <label for="Category_id"><b> CHOISIR CATEGORIE</b></label><br>
              @foreach ($CatCom as $CatCom)
              <input type="checkbox" name="Category_id" value="{{ $CatCom->id }}">{{ $CatCom->title }}<br>
              @endforeach

            </fieldset>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </form>
    </div>
@endsection