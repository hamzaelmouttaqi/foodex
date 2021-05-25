@extends('layouts.app' ,['activePage' => 'Commandelist', 'titlePage' => __('Modifier commande')])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title "> <b>Modifier commande</b></h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route("commande.update",$commande->id) }}" method="post" enctype="multipart/form-data">
                            @csrf 
                            @method("PUT")
                            <select name="id_client">
                                <option value="{{$commande->nom_client}}" >{{$commande->nom_client}}</option>
                                {{--@foreach ($client as $client)
                                    <option name="id_client" value="{{$client->id}}">{{$client->nom.' '.$client->prenom }}</option>
                                @endforeach--}}
                            </select>
                            
                            
                            <br><br>
                
                            <select name="categorie[]" id="nomcat" }>
                                <option  value="" disabled selected>Categorie</option>
                                @foreach ($categorie as $categorie)
                                    @if ($categorie->status == '1')
                                    <option value="{{$categorie->nomCat}}" >{{$categorie->nomCat}}</option>
                                    @endif
                                @endforeach 
                            </select>
                            <div class="card-group">
                                @foreach ($alimentaires as $alimentaire)
                                <div class="{{$alimentaire->categorie_nom}} data" data-id="alim"  style="display: none">
                                    <div class="card">
                                        <img  src="{{ asset('uploads/alimentaire/image/'. $alimentaire->image ) }}" height="60" width="60" class="fluid mx-auto justify-content-center" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$alimentaire->titre}}</h5>
                                            <p class="card-text">{{$alimentaire->description}}</p>
                                            @php
                                                $cmp1=DB::table('composants')->select('id')->pluck('id')->toArray();
                                                $cmp2=DB::table('alimentaire_composant')->select('composant_id')->where('alimentaire_id',$alimentaire->id)->pluck('composant_id')->toArray();
                                                $diff=array_merge(array_diff($cmp1,$cmp2));
                                                $inter=array_intersect($cmp1,$cmp2);
                                                
                                            @endphp
                                            {{--@foreach ($compo as $comp)--}}
                                            <fieldset>
                                                <label>Composants:</label><br> 
                                                @foreach ($compos as $comp)
                                                @foreach ((array)$inter as $inters)
                                                    @if ($comp->id === $inters)
                                                    <input type="checkbox" name="alimentaire_{{$alimentaire->id}}[]" value="{{$comp->nomComposant}}" checked placeholder="composantCommande">{{ $comp->nomComposant}}<br>
                                                    @endif
                                                @endforeach
                                                @endforeach
                                            </fieldset><br>
                                            <fieldset>
                                                <label>Ingredients payant:</label><br>
                                                @foreach ($compos as $comp) 
                                                @foreach ((array)$diff as $diffs)
                                                    @if ($comp->id === $diffs)
                                                    <input type="checkbox" name="ingredient_{{$alimentaire->id}}[]" value="{{$comp->nomComposant}}" placeholder="composantCommande">{{ $comp->nomComposant}} : {{ $comp->prix}} DH
                                                    <input type="number" min="1" max="5" value="1" name="quantite_{{$alimentaire->id}}_{{$comp->nomComposant}}" id="">
                                                    <br>
                                                    @endif
                                                @endforeach
                                                @endforeach
                                            </fieldset><br>
                                            {{--@endforeach--}}
                                            <fieldset>
                                                <label>Sizes:</label><br>
                                                @foreach ($alimentaire->sizes as $size)
                                                    <input class="size-enable" type="radio" name="size_{{ $alimentaire->id }}" data-id="{{ $size->id }}" value="{{$size->pivot->prix}},{{$size->title}}">{{$size->title}}
                                                @endforeach 
                                            </fieldset>
                                            <fieldset>
                                                <label>Supplements:</label><br>
                                                @foreach ($supplements as $supplement)
                                                    <input type="checkbox" name="supplement_{{$alimentaire->id}}[]" value="{{$supplement->titre}}" >{{ $supplement->titre}}<pre> : {{$supplement->prix}}</pre><br>
                                                @endforeach
                                            </fieldset>
                                            <fieldset>
                                                <br><input  type="checkbox" data-id="{{$alimentaire->id}}"  name="ali[]" value="{{$alimentaire->id}}"> 
                                                <input type="number" min="1"  value="1" name="quantite_{{$alimentaire->id}}" >
                                            </fieldset> 
                                        </div>                      
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            <br><button type="submit" class="btn btn-primary">Modifier commande</button>
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
                                         <i class="material-icons">delete</i></button>
                               
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