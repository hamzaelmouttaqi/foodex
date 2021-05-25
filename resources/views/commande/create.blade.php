@extends('layouts.app',['activePage' => 'Commandeadd', 'titlePage' => __('Ajouter commande')])

@section('content')
    <div class="content">
        <div class="row">
          <div class="col-md-8">
            <form action="{{ route("commande.insert") }}" method="POST" class="form-vertical">
              @csrf
              <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel">choisir votre alimentaire</h5>
                      <button type="button" class="btn btn-dark btn-sm"  data-bs-dismiss="modal" aria-label="Close"><i class="material-icons">close</i></button>
                    </div>
                    <div class="modal-body">
                      <div>
                        <div class="form-group">
                          <label for="nom">Nom</label>
                          <input type="text" class="form-control" name="nom" placeholder="Enter nom">
                        </div>
                        <div class="form-group">
                          <label for="Prenom">Prenom</label>
                          <input type="text" class="form-control" name="Prenom" placeholder="Prenom">
                        </div>
                        <div class="form-group">
                            <label for="date_de_naissance">Date De Naissance</label>
                            <input type="date" class="form-control" name="date_de_naissance" placeholder="0000-00-00">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="tele">Numero Tele</label>
                            <input type="text" class="form-control" name="tele" placeholder="Numero">
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" name="adresse" placeholder="Adresse">
                        </div>
                        <div class="form-group">
                            <label for="code_postal">Code Postal</label>
                            <input type="number" class="form-control" name="code_postal" placeholder="Code Postal">
                        </div>
                      </div>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">ajouter</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title "> <b>Ajouter commande</b></h4>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                      <form action="{{ route("commande.store") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-row">
                          <select name="id_client" class="form-control w-50" aria-placeholder="Nom Client">
                            <option value="" disabled selected>Nom Client</option>
                            @foreach ($clients as $client)
                                <option name="id_client"value="{{ $client->id }}">{{ $client->nom.' '.$client->Prenom }}</option>
                            @endforeach
                          </select>
                          <a class="nv btn btn-dark btn-sm" style="margin-left: 20"  data-bs-target="#Modal" data-bs-toggle="modal">+ Nouveau Client</button>
                          </a>
                        </div>
                        <br>
                        <br>
                            <select name="categorie" id="nomcat" class="form-control" style="width: 500px" >
                              <option value="" disabled selected>Choose your categorie</option>
                              @foreach ($categorie as $categorie)
                              @if ($categorie->status=='1')
                              <option value="{{ $categorie->nomCat }}">{{ $categorie->nomCat}}</option>
                              @endif
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
                                  @php
                                  
                                      $camp=DB::table('composants')->select('id')->pluck('id')->toArray();
                                      $comp=DB::table('alimentaire_composant')->select('composant_id')->where('alimentaire_id', $alimentaire->id )->pluck('composant_id')->toArray();
                                      $diff=array_merge(array_diff($camp,$comp)); 
                                      $inter=array_merge(array_intersect($camp,$comp));
                                   
                                      
                                  @endphp
                                  <label for="composants"><b>Composants</b></label>
                                    @foreach ($compos as $compo)
                                        <fieldset>                       
                                          @foreach ((array)$inter as $inters)
                                            @if ($compo->id==$inters)
                                            <input type="checkbox" name="alimentaire_{{ $alimentaire->id }}[]" value="{{ $compo->nomComposant }}" checked>{{ $compo->nomComposant }}<br>
                                            @endif                       
                                        @endforeach                 
                                        </fieldset>
                                        @endforeach  
                                   <label for="composants"><b>Composants Payants</b></label>
                                    @foreach ($compos as $compo)
                                        <fieldset>
                                          @foreach ((array)$diff as $diffs)
                                            @if ($compo->id==$diffs)
                                            <input type="checkbox" name="ingredient_{{ $alimentaire->id }}[]" value="{{ $compo->nomComposant }}" ><pre>{{ $compo->nomComposant }}   {{ $compo->prix }}</pre>
                                            <input type="number" min="1" max="5" value="1" name="quantite_{{ $alimentaire->id }}_{{ $compo->nomComposant }}">
                                            @endif                       
                                          @endforeach  
                                        </fieldset>
                                    @endforeach
                                   
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
                                      <input type="number" min="1" value="1" name="quantite_{{ $alimentaire->id }}">
                                    </fieldset>
                                  </div>
                                </div>
                              </div>
                              
                              @endforeach
                            </div>       
                            <br>
                            <button type="submit" class="btn btn-primary">Ajouter</button> 
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 

@section('scripts')
    @parent
    <script>
        $(document).ready(function(){
          $("#nomcat").on('change',function(){
            $(".data").hide();
            $("." + $(this).val()).fadeIn(700);
          }).change();
       })
   
        $('document').ready(function () {
            $('.size-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.size-prix[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.size-prix[data-id="' + id + '"]').val(null)
            })
        }); 

        $(function() {
            $(".nv").on('click',function() {
                $("#Modal").modal('show')
            })
        })



        //ajout client
        /*$(function() {
      $('.toggle-class').on('click',function() {
  
  
          //var id = $(this).data('id'); 
          //var nom = $(this).(input('[name="nom"]')).val();
          var nom = $(this).attr('[name="nom"]');
          var prenom = $(input('[name="prenom"]')).val();
          var adresse = $(input('[name="adresse"]')).val();
          var email = $(input('[name="email"]')).val();
          var codePostal = $(input('[name="codePostal"]')).val();
          var dateNaissance = $(input('[name="dateNaissance"]')).val();
          var tele = $(input('[name="tele"]')).val();
            alert(nom);
          /*$.ajax({
  
              type: "GET",
  
              dataType: "json",
  
              url: '/store',
  
              data: {'id': id},
  
              success: function(data){
  
                console.log(data.success);
                location.reload();
              }  
          })
      })  
    })*/
    </script>
@endsection