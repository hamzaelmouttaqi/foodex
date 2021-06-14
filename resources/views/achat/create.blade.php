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
                          <select name="fournisseurId" id="fourni" class="form-control" style="width: 500px" class="form-control w-50" aria-placeholder="Nom Client">
                            <option value="" disabled selected>Nom Fournisseur</option>
                            @foreach ($fournisseurs as $fournisseur)
                                <option name="fournisseurId" value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
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
                                    <tr align="center">
                                      <th>Produit</th>
                                      <th>Prix-Unitaire</th>
                                      <th></th>
                                      <th>Quantite</th>
                                      <th>Prix</th>
                                    </tr>
                                    @foreach ($fournisseur->produits as $produit)
                                    <tr>
                                        <td>
                                            <input class="produits-enable" data-td='{{ $fournisseur->id }}' onclick="check({{ $produit->id }},{{ $fournisseur->id }})" type="checkbox" name="{{ $produit->id }}" data-id="{{ $produit->id }}" value="{{$produit->id}}"> {{$produit->titre}}
                                          </td>
                                          <td>
                                            <input type="text"  class="prix-uni_{{ $produit->id }}{{ $fournisseur->id }} form-control" data-id="{{ $produit->id }}" style="border: 0;text-align:center" name=""  value="{{ $produit->pivot->prix_unitaire }}" disabled>
                                        </td>
                                        <td></td>
                                          <td >
                                            <input type="text"  min="0" class="produit-quantite form-control" style="border: 0;text-align:right" name="quantite[{{ $produit->id }}]" data-id="{{ $produit->id }}{{ $fournisseur->id }}" placeholder="0" onkeyup="calculate_store({{ $produit->id }},{{ $fournisseur->id }})" disabled>
                                          </td>
                                        <td>
                                          <input type="text" value="0.00" class="prix-total form-control" name="prix-total[]"  id="prix-total_{{ $produit->id }}{{ $fournisseur->id }}" data-id="{{ $produit->id }}" style="border: 0;text-align:center" name=""  placeholder="0.00" disabled>
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
                        
                          <table class="t" style="display: none">
                            <tr>
                              <td colspan="2"></td>
                              <td>Total</td>
                              <td> 
                              <input type="number" value="0" id="grandTotal" readonly='readonly' class="form-control"  style="border: 0;text-align:center"  disabled>
                              </td>
                            </tr>
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
          $("#fourni").on('change',function(){
            $(".data").hide();
            $("." + $(this).val()).fadeIn(700)
            $('.t').fadeIn(700)
            $('.produits-enable').prop('checked', false);
            $(".produits-enable").each(function() {
              let dd = $(this).attr('data-id')
              let fd = $(this).attr('data-td')
              check(dd,fd)
          });
          });
       })
      //  $('document').ready(function () {
      //       $('.produits-enable').on('click', function () {
      //           let id = $(this).attr('data-id')
      //           let enabled = $(this).is(":checked")
      //           $('.produit-quantite[data-id="' + id + '"]').attr('disabled', !enabled)
      //           $('.produit-quantite[data-id="' + id + '"]').val(null)
      //           $("#grandTotal").val($("#grandTotal").val()-$("#prix-total_"+id).val());
      //           $("#prix-total_"+id).val(null)

      //       })
      //   });

      function check(id,fd) {

                
                let enabled = $('.produits-enable').is(":checked")
                $('.produit-quantite[data-id="' + id + fd +'"]').attr('disabled', !enabled)
                $('.produit-quantite[data-id="' + id + fd +'"]').val(null)
                $("#grandTotal").val($("#grandTotal").val()-$("#prix-total_"+id+fd).val());
                $("#prix-total_"+id+fd).val(null)
      } 
       
        //Calculate store product

      function calculate_store(id,fd) { 
          
          var tot = 0;
          var prix_uni    = $(".prix-uni_"+id+fd).val();
          var quantite = $('.produit-quantite[data-id="' + id + fd + '"]').val();
          var total_price     = prix_uni * quantite;

          $("#prix-total_"+id+fd).val(total_price.toFixed(2));
            
          //Total Price
            
          $(".prix-total").each(function() {
              isNaN(this.value) || 0 == this.value.length || (tot += parseFloat(this.value))
          });
          $("#grandTotal").val(tot.toFixed(2,2));
      }


    </script>
@endsection