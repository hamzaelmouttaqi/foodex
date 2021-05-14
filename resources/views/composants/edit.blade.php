@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route("composants.update",$composant->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-group">
              <label for="nomComposant">nomComposant</label>
              <input type="text" class="form-control" name="nomComposant" placeholder="Enter nomComposant" value="{{ $composant->nomComposant }}">
            </div>
            <div class="form-group">
              <label for="categorie">categorie</label>
              <input type="text" class="form-control" name="categorie" placeholder="categorie" value="{{ $composant->categorie }}">
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
              @foreach ($CatCom as $CatCom)
              <input type="checkbox" name="Category_id" value="{{ $CatCom->id }}">{{ $CatCom->title }}<br>
              @endforeach
            <button type="submit" class="btn btn-primary">Modifier</button>
          </form>
    </div>
@endsection