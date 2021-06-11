@extends('layouts.app',['activePage' => 'Achat', 'titlePage' => __('Ajouter Achat')])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title "> <b>Ajouter Achat</b></h4>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                      <form action="{{ route("achat.store") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-row">
                          <select name="id_fournisseur" id="fourni" class="form-control" style="width: 500px" class="form-control w-50" aria-placeholder="Nom Client">
                            <option value="" disabled selected>Nom Fournisseur</option>
                            @foreach ($fournisseurs as $fournisseur)
                                <option name="id_fournisseur" value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                            @endforeach
                          </select>
                          <a class="btn btn-dark btn-sm" style="margin-left: 20"  href="{{ route('fournisseur.create') }}">+ Nouveau Fournisseur
                          </a>
                        </div>
                        <br>
                        @foreach ($fournisseurs as $fournisseur)
                        <div class="row">  
                            <div class="col-lg-2 col-md-2 col-sm-2" ></div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="{{ $fournisseur->id }} data" style="display: none"> 
                                <div class="card"> 
                                  <div class="card-body">
                                <table class="table">
                                    @foreach ($fournisseur->produits as $produit)
                                    <tr>
                                        <td>
                                            <input class="produits-enable" type="checkbox" name="{{ $produit->id }}" data-id="{{ $produit->id }}" value="{{$produit->id}}"> {{$produit->titre}}
                                          </td>
                                          <td>
                                            {{ $produit->pivot->prix_unitaire }}
                                        </td>
                                        <td></td>
                                          <td >
                                            <input type="number"  class="produit-quantite form-control" style="border: 0;text-align:right" name="produit[{{ $produit->id }}]" data-id="{{ $produit->id }}" placeholder="  0" disabled>
                                          </td>
                                                                
                                    </tr>
                                    @endforeach
                                </table>
                                  </div>
                                </div>
                                </div>
                            </div>
                            
                        </div>
                        @endforeach
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
          $("#fourni").on('change',function(){
            $(".data").hide();
            $("." + $(this).val()).fadeIn(700);
          }).change();
       })
       $('document').ready(function () {
            $('.produits-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.produit-quantite[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.produit-quantite[data-id="' + id + '"]').val(null)
            })
        }); 
    </script>
@endsection