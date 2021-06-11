@extends('layouts.app' , ['activePage' => 'fournisseurlist', 'titlePage' => __('Ajouter fournisseur ')])
@section('content')
    <div class="content">
      <div class="row">
        <div class="col-md-8">
          <form action="{{ route("fournisseur.insert") }}" method="POST" class="form-vertical">
            @csrf
            <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Ajouter un produit</h5>
                    <button type="button" class="btn btn-dark btn-sm"  data-bs-dismiss="modal" aria-label="Close"><i class="material-icons">close</i></button>
                  </div>
                  <div class="modal-body">
                    <div>
                      <div class="form-group">
                        <label for="titre">Nom de Produit</label>
                        <input type="text" class="form-control" name="titre" placeholder="Enter Titre">
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
      <div class="col-md-10 mx-auto">
        <div class="card">
          <div class="card-header card-header-primary">
            
              <h4 class="card-title "> <b>Fournisseurs</b> 
                </h4>
              <p class="card-category"> Ajouter des Fournisseurs</p>
          </div>
        <div class="card-body">
        <form action="{{route('fournisseur.store')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" name="nom" aria-describedby="nom" placeholder="Enter nom">
            </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="tele">N° tele</label>
                <input type="text" class="form-control" name="tele" aria-describedby="tele" placeholder="Enter tele">
              </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Adresse</label>
              <input type="text" class="form-control" name="adresse" placeholder="adresse">
            </div>
            <label for="Produit">Produits</label>
            <table class="table w-50 mx-auto" >
              @foreach ($produits as $produit)
                  <tr>
                    
                      <td>
                        <input class="produits-enable" type="checkbox" name="{{ $produit->id }}" data-id="{{ $produit->id }}" value="{{$produit->id}}"> {{$produit->titre}}
                      </td>
                      <td >
                        <input type="number" step="any" class="produit-prix form-control" style="border: 0;text-align:right" name="produit[{{ $produit->id }}]" data-id="{{ $produit->id }}" placeholder="  0 DH" disabled>
                      </td>
                    
                  </tr>
              @endforeach
              
            </table>
            <a class="nv btn btn-dark btn-sm" style="margin-left: 20"  data-bs-target="#Modal" data-bs-toggle="modal">+ Nouveau Produit</button>
            </a>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </form>
    </div>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
      $(function() {
                $(".nv").on('click',function() {
                    $("#Modal").modal('show')
                })
            });
           
      $('document').ready(function () {
            $('.produits-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.produit-prix[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.produit-prix[data-id="' + id + '"]').val(null)
            })
        }); 
   

    </script>
@endsection