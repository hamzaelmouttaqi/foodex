@extends('layouts.app', ['activePage' => 'fournisseurlist', 'titlePage' => __('Fournisseur list')])

@section('content')
<div class="content">
  <div class="col-md-10 mx-auto">
    <div class="card">
      <div class="card-header card-header-primary">
        
          <h4 class="card-title "> <b>Fournisseurs</b> <a href="{{route('fournisseur.create')}}" class="btn btn-info" style="float: right">
            <i class="material-icons">add</i></a></h4>
          <p class="card-category"> liste des Fournisseurs</p>
      </div>
    <div class="card-body">
   
    <table class="table">
        <thead>
          <tr align="center">
            <th scope="col">id</th>
            <th scope="col">Nom</th>
            <th scope="col">email</th>
            <th scope="col">tele</th>
            <th scope="col">adresse</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($fournisseur as $fournisseur)
              <tr align="center">
                  <td>{{$fournisseur->id }}</td>
                  <td>{{$fournisseur->nom }}</td>
                  <td>{{$fournisseur->email }}</td>
                  <td>{{$fournisseur->tele }}</td>
                  <td>{{$fournisseur->adresse }}</td>
                  <td class="d-flex flex-row justify-content-center align-items-center">
                    <a class="pn btn btn-dark m-2 btn-sm" data-id={{ $fournisseur->id }} data-bs-target="#Modal_{{ $fournisseur->id }}" data-bs-toggle="modal">
                      <i class="material-icons">
                        filter_list
                      </i>
                   </a>

                    <a href="{{route('fournisseur.edit' ,$fournisseur->id)}}" class="btn btn-warning m-2 btn-sm">
                        <i class="fas fa-edit "></i>
                    </a>
                    <form id="{{$fournisseur->id}}" action={{ route('fournisseur.destroy',$fournisseur->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer le fournisseur {{ $fournisseur->nom }} {{ $fournisseur->prenom }}?'))
                                document.getElementById({{ $fournisseur->id }}).submit();">
                                <i class="fas fa-trash"></i></button>
                    </form>

                </td>
                    
              </tr>
              <div class="modal fade" id="Modal_{{ $fournisseur->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true" style="display: none !important">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel">liste de  Produit</h5>
                      <button type="button" class="btn btn-dark btn-sm"  data-bs-dismiss="modal" aria-label="Close"><i class="material-icons">close</i></button>
                    </div>
                    <div class="modal-body" >                   
                          @foreach ($fournisseur->produits as $produit)
                              <div class="row">
                                <div class="col-md-6" style="text-align: center"> {{ $produit->titre }}</div>
                                <div class="col-md-6" style="text-align: center">{{ $produit->pivot->prix_unitaire }} DH</div>
                             
                              </div>
                                <hr>
                          @endforeach
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
          @endforeach

        </tbody>
      </table>
    </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
    @parent
    <script>
      $(function() {
                $(".pn").on('click',function() {
                  let id = $(this).attr('data-id');
                    $("#Modal"+id).modal('show');
                })
            });
    </script>
@endsection