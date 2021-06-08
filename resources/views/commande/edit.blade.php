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
                           
                            <select name="id_client" class="form-control w-50" aria-placeholder="Nom Client">
                                <option value="{{$commande->nom_client}}" >{{$commande->nom_client}}</option>
                              </select>
                            
                            
                            <br><br>
                
                            <select name="categorie" id="nomcat" class="form-control" style="width: 500px" >
                                <option value="" disabled selected>Choose your categorie</option>
                                @foreach ($categorie as $categorie)
                                @if ($categorie->status=='1')
                                <option value="{{ $categorie->nomCat }}">{{ $categorie->nomCat}}</option>
                                @endif
                                @endforeach
                              </select>
                             
                              <div class="row">
                                @foreach ($alimentaires as $alimentaire)
                                
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                  <div class="{{ $alimentaire->categorie }} data" style="display: none"> 
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