@extends('layouts.app')

@section('content')
<style>
  
</style>
    <div class="container">
      <form action="{{ route("commande.update",$commande->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           <select name="id_client">
             <option value="{{ $commande->nom_client }}" disabled selected>{{ $commande->nom_client }}</option>
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
          
          <button type="submit" class="btn btn-primary">Ajouter</button> 
      </form>
          <table class="table">
            <tr>
              <th scope="col">alimentaire</th>
              
              <th scope="col">size</th>
              <th scope="col">prix</th>
              <th scope="col">Action</th>
            </tr>
            @foreach ($commande->alimentaires as $alim)
            <tr>
                <td>
                  {{ $alim->titre }}
                  <button data-id="{{ $commande->id }}{{ $alim->id }}" type="button" class="sh plus{{ $commande->id }}{{ $alim->id }} ml-5" data-name="{{ $alim->id }}">+</button>
                  <button data-id="{{ $commande->id }}{{ $alim->id }}" type="button" class="hi moins{{ $commande->id }}{{ $alim->id }} ml-5" style="display: none">-</button>
                </td>
               
                   
                
                <td>{{ $alim->pivot->sizeAlimentaire }}</td>
                <td>{{ $alim->pivot->prixAlimentaire }}</td>
                <td >
                  
                        <button data-id="{{ $alim->pivot->id }}"
                         class="toggle-class btn btn-danger btn-sm mt-2" >
                            <i class="fas fa-trash"></i></button>
               
                </td>
            </tr>
            <tr>
              <td colspan="2">
                <table class="{{ $commande->id }}{{ $alim->id }}" style="display:none">
                  <tr>
                    <td width=120>
                      @foreach (json_decode($alim->pivot->composantCommande) as $comp)
                      <i class="fa fa-minus" aria-hidden="true"></i> {{$comp}}<br>
                      @endforeach
                    </td>
                    <td width=150>
                      @foreach (json_decode($alim->pivot->supplementCommande) as $sup)
                              <i class="fa fa-plus fa-sm" aria-hidden="true"></i> {{$sup}} <br>
                      @endforeach
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            @endforeach
          </table>
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
       //supprimer alim
       $(function() {
      $('.toggle-class').on('click',function() {
  
  
          var id = $(this).data('id'); 
  
          $.ajax({
  
              type: "GET",
  
              dataType: "json",
  
              url: '/supprimer',
  
              data: {'id': id},
  
              success: function(data){
  
                console.log(data.success);
                location.reload();
              }
  
          });
  
      })
  
    })
      //show details
      $(function() {
      $('.sh').on('click',function() {
        var id = $(this).data('id'); 
        
        $('.'+id).show();
        $(".plus"+id).hide();
        $(".moins"+id).show();
    })
    $('.hi').on('click',function() {
        var id = $(this).data('id'); 
        $("."+id).hide();
        $(".plus"+id).show();
        $(".moins"+id).hide();
    })
      
    })
    </script>
@endsection