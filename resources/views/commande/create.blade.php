@extends('layouts.app')

@section('content')
<style>
  
</style>
    <div class="container">
        <form action="{{ route("commande.store") }}" method="post" enctype="multipart/form-data">
            @csrf
           <select name="nom_client" aria-placeholder="Nom Client">
             <option value="Nom Client"disabled selected>Nom Client</option>
             @foreach ($clients as $client)
                 <option value="{{ $client->id }}">{{ $client->nom.' '.$client->Prenom }}</option>
             @endforeach
           </select>
          <select name="categorie" id="nomcat">
            <option value="" disabled selected>Choose your categorie</option>
            @foreach ($categorie as $categorie)
            <option value="{{ $categorie->nomCat }}">{{ $categorie->nomCat}}</option>
            @endforeach
          </select>
          <div class="card-deck">
            @foreach ($alimentaires as $alimentaire)
            <div class="{{ $alimentaire->categorie }} data" style="display: none"> 
                <div class="card">
                <img src="{{ asset('uploads/alimentaire/image/'. $alimentaire->image ) }}" width="60" height="60" class="fluid mx-auto justify-content-center" >
                <div class="card-body">
                  <h5 class="card-title">{{ $alimentaire->titre }}</h5>
                  <p class="card-text">{{ $alimentaire->description }}</p>
                  <fieldset>
                    @foreach ($alimentaire->composants as $comp)                         
                      <input type="checkbox" name="composants[]" value="{{ $comp }}" checked>{{ $comp }}<br>
                    @endforeach
                  </fieldset>
                </div>
              </div>
            </div>
            
            @endforeach
          </div>       
          <button type="submit" class="btn btn-primary">Ajouter</button> 
    </div>
@endsection
@section('scripts')
    @parent
    <script>
       $(document).ready(function(){
          $("#nomcat").on('change',function(){
            $('.data').hide()
            $("."+$(this).val()).fadeIn(700)
          }).change();
       })
    </script>
@endsection