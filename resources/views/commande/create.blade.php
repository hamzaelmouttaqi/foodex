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
                              <option value="{{ $categorie->nomCat }}" data-id="{{ $categorie->nomCat }}">{{ $categorie->nomCat}}</option>
                              @endif
                              @endforeach
                            </select>
                           
                            <div class="row">
                              @foreach ($alimentaires as $alimentaire)
                              
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="{{ $alimentaire->categorie }} data" style="display: none;"> 
                                <div class="card">
                                  
                                    <img class="card-img-top" width='400' height='250' src="{{ asset('uploads/alimentaire/image/'. $alimentaire->image ) }}" alt="card_img">
                                  
                                  <div class="card-body ">
                                    <div class="card-title">
                                      <table>
                                          <tr style="font-weight: 900">
                                              <td width='300px' style="text-transform: uppercase;color: black;">
                                                  <h4><strong>{{ $alimentaire->titre }}</strong></h4>
                                              </td>
                                              <td bgcolor="#ff9800" style="border-radius: 50%;width: 50px;color: black;font-weight: 900" align="center">
                                                 {{ $alimentaire->categorie }}
                                              </td>
                                          </tr>
                                      </table>
                                    </div>
                                    <div class="card-text">
                                    <table style="width: 400px">
                                    
                                      <tr align="left">
                                        <td width="150px">
                                          <input type="checkbox" class='alimcomp'  data-id="{{ $alimentaire->id }}" name="ali[]" value=" {{ $alimentaire->id }}" >
                                        </td>
                                        <td>
                                          @foreach ($alimentaire->sizes as $size)
                                            <input type="radio" name="sizes_{{ $alimentaire->id }}" value="{{ $size->pivot->prix }}|{{ $size->title }}">{{ $size->title }}-{{ $size->pivot->prix }}DH <br>
                                          @endforeach
                                        </td>
                                        <td>
                                          
                                        QTE: <input type="number" min="1" value="1" class='form-control'name="quantite_{{ $alimentaire->id }}" style="width: 50px">
                                        </td>
                                      </tr>
                                    </table>
                                    <div id='add_{{ $alimentaire->id }}' style="display: none">
                                    @php
                                  
                                      $camp=DB::table('composants')->select('id')->pluck('id')->toArray();
                                      $comp=DB::table('alimentaire_composant')->select('composant_id')->where('alimentaire_id', $alimentaire->id )->pluck('composant_id')->toArray();
                                      $diff=array_merge(array_diff($camp,$comp)); 
                                      $inter=array_merge(array_intersect($camp,$comp));
                                   
                                      
                                  @endphp
                                          {{-- COMPOSANTS --}}
                                  <div>
                                  <a class="compo btn" data-id="{{ $alimentaire->id }}" 
                                    style="background-color: #ffff;box-shadow: none;color: black;font-weight: 900"
                                    for="composants">Composants</a>
                                    <div id="com_{{ $alimentaire->id }}" style="display: none">
                                    @foreach ($compos as $compo)
                                                              
                                          @foreach ((array)$inter as $inters)
                                            @if ($compo->id==$inters)
                                            <input type="checkbox" name="alimentaire_{{ $alimentaire->id }}[]" value="{{ $compo->nomComposant }}" checked> {{ $compo->nomComposant }}<br>
                                            @endif                       
                                        @endforeach                 
                                        
                                        @endforeach  
                                    </div>
                                  </div>
                                        {{-- COMPOSANTS PAYANTS --}}
                                  <div>
                                   <a class="composant btn" data-id="{{ $alimentaire->id }}" style="color: black;font-weight: 900;
                                   background-color: #ffff;box-shadow: none"
                                     for="composants" >Composants Payants</a>
                                    <div id="comp_{{ $alimentaire->id }}" style="display: none">
                                      <table width="100%">
                                        @foreach ($compos as $compo)
                                          <tr>
                                            <td>
                                              <input type="checkbox" name="ingredient_{{ $alimentaire->id }}[]" value="{{ $compo->nomComposant }}" >
                                            </td>
                                            <td>
                                              {{ $compo->nomComposant }}
                                            </td>
                                            <td>
                                              {{ $compo->prix }} DH
                                            </td>
                                            <td>
                                              <input type="number" min="1" max="5" value="1" name="quantite_{{ $alimentaire->id }}_{{ $compo->nomComposant }}">
                                            </td>
                                          </tr>
                                    @endforeach
                                      </table>
                                    
                                  </div>
                                </div>
                                        {{-- SUPPLEMENTS --}}
                                    <a class="supplement btn" data-id="{{ $alimentaire->id }}" style="background-color: #ffff;box-shadow: none;
                                      color: black;font-weight: 900" for="supplement"><b>Supplements</b></a>
                                    <div id="supp_{{ $alimentaire->id }}" style="display: none">
                                      <table width="100%">
                                        @foreach ($supplements as $supp)
                                        <tr>
                                          <td>
                                            <input type="checkbox" name="supplement_{{ $alimentaire->id }}[]" 
                                            value="{{ $supp->titre }}">
                                          </td>
                                          <td>
                                            {{ $supp->titre }} 
                                          </td>
                                          <td>
                                            {{ $supp->prix }} DH
                                          </td>
                                        
                                        @endforeach
                                      </tr>
                                      </table>
                                     
                                    </div>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              </div>
                              
                              @endforeach
                            </div>
                          
                              
                            {{-- <div class="card-deck">
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
                            </div>        --}}
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
            let id = $(this).attr('data-id')
            $(".data").hide()
            $("." + $(this).val()).fadeIn(700)
            
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
        $(document).ready(function(){
          $(".alimcomp").on('click',function(){
            let id = $(this).attr('data-id')
            $("#add_"+id).toggle(700);
          }).change();
       })
       $(document).ready(function(){
          $(".supplement").on('click',function(){
            let id = $(this).attr('data-id')
            $("#supp_"+id).toggle(700);
          });
       })
       $(document).ready(function(){
          $(".composant").on('click',function(){
            let id = $(this).attr('data-id')
            $("#comp_"+id).toggle(900);
          });
         
       })
       $(document).ready(function(){
          $(".compo").on('click',function(){
            let id = $(this).attr('data-id')
            $("#com_"+id).toggle(700);
          });
       })
    </script>
@endsection