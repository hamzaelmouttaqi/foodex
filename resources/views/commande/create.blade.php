@extends('layouts.app')

@section('content')
<style>
  
</style>
    <div class="container">
        <form action="{{ route("commande.store") }}" method="post" enctype="multipart/form-data">
            @csrf
           <select name="id_client" aria-placeholder="Nom Client">
             <option value="" disabled selected>Nom Client</option>
             @foreach ($clients as $client)
                 <option name="id_client"value="{{ $client->id }}">{{ $client->nom.' '.$client->Prenom }}</option>
             @endforeach
           </select>
          <select name="categorie" id="nomcat" class="form-control" style="width: 500px" >
            <option value="" disabled selected>Choose your categorie</option>
            @foreach ($categorie as $categorie)
            @if ($categorie->status=='1')
            <option value="{{ $categorie->nomCat }}" data-bs-target="#Modal" data-bs-toggle="modal">{{ $categorie->nomCat}}</option>
            @endif
            @endforeach
          </select>
         
         {{-- Modal --}}
         
         
          {{-- <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">choisir votre alimentaire</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                              <input type="checkbox" name="alimentaire[{{ $alimentaire->id }}]" value="{{ $comp->id }}" >{{ $comp->nomComposant }}<br>
                            @endforeach
                          </fieldset><br>
                          <fieldset>
                            <input type="checkbox" data-id="{{ $alimentaire->id }}">
                          </fieldset>
                        </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">ajouter</button>
                </div>
              </div>
            </div>
          </div> --}}
            
          <div class="card-deck">
            @foreach ($alimentaires as $alimentaire)
            <div class="{{ $alimentaire->categorie }} data" style="display: none"> 
                <div class="card">
                <img src="{{ asset('uploads/alimentaire/image/'. $alimentaire->image ) }}" width="60" height="60" class="fluid mx-auto justify-content-center" >
                <div class="card-body">
                  <h5 class="card-title">{{ $alimentaire->titre }}</h5>
                  <p class="card-text">{{ $alimentaire->description }}</p>
                  <label for="composants"><b>Composants</b></label>
                  <fieldset>                       
                    @foreach ($alimentaire->composants as $comp)                         
                    <input type="checkbox" name="alimentaire_{{ $alimentaire->id }}[]" value="{{ $comp->nomComposant }}">{{ $comp->nomComposant }}<br>
                  @endforeach                   
                  </fieldset>
                  <label for="sizes"><b>sizes</b></label>
                  <fieldset>
                    @foreach ($alimentaire->sizes as $size)
                      
                    <input type="radio" name="sizes_{{ $alimentaire->id }}" value="{{ $size->pivot->prix }}|{{ $size->title }}">{{ $size->title }}
                   @endforeach
                  </fieldset>
                  <label for="supplement"><b>Supplemet</b></label>
                  <fieldset>
                    @foreach ($supplements as $supp)
                    <input type="checkbox" name="supplement_{{ $alimentaire->id }}[]" 
                    value="{{ $supp->titre }}"><pre>{{ $supp->titre }}           {{ $supp->prix }}</pre>
                    @endforeach
                  </fieldset>
                  <fieldset>
                    <input type="checkbox"  data-id="{{ $alimentaire->id }}" name="ali[]" value=" {{ $alimentaire->id }}" >
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
       $(function(){
          $("#nomcat").on('change',function(){
            $("#Modal").modal('show')
            $('.data').hide()
            $("."+$(this).val()).fadeIn(700)
          });
       })
    </script>
@endsection