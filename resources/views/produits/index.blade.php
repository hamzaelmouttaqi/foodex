@extends('layouts.app', ['activePage' => 'Produits', 'titlePage' => __('Produits')])

@section('content')
    <div class="content">
      <div class="col-md-8 mx-auto">
        <div class="card">
          <div class="card-header card-header-primary">
            
              <h4 class="card-title "> <b>Produits</b> <a href="{{ route('produit.create') }}" class="btn btn-info" style="float: right">
                <i class="material-icons">add</i></a></h4>
              <p class="card-category"> liste des Produit</p>
          </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr style="text-align: center">
                <th scope="col">id</th>
                <th scope="col">Nom Produits</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($produits as $produit)
                  <tr style="text-align: center">
                    <td>{{$produit ->id}}</td>
                    <td><strong>{{ $produit->titre }}</strong></td>
                    <td>
                    <form id="{{$produit->id}}" action={{ route('produit.destroy',$produit->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer l composants {{ $produit->titre }}?'))
                                document.getElementById({{ $produit->id }}).submit();">
                                <i class="material-icons">delete</i></button>
                    </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
            <tfoot>
              <td  align="right">{{ $produits->links() }}</td>
              </tfoot>
          </table>
      </div>
        </div>
    </div>
@endsection
