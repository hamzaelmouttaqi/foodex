@extends('layouts.app', ['activePage' => 'Livraison', 'titlePage' => __('Ajouter Ville')])

@section('content')
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> <b>Ville</b>
              @if (Auth::user()->hasRole('administrator'))
               <a href="{{ route('livraison.create') }}" class="btn btn-light" style="float: right">
              <i class="material-icons">add</i></a>
              @endif
            </h4>
            <p class="card-category"> liste des Villes</p>
          </div>
          <div class="card-body">
            
          <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nom Ville</th>
                  <th scope="col">Code Postal</th>
                  <th scope="col">Prix livraison</th>
                  @if (Auth::user()->hasRole('administrator'))
                  <th scope="col">action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($livraison as $livraison)
                    <tr>
                        <td>{{$livraison->ville }}</td>
                        <td>{{$livraison->code_postal }}</td>
                        <td>{{$livraison->prix }} DHs</td>
                        
                        @if (Auth::user()->hasRole('administrator'))
                        <td class="d-flex flex-row justify-content-center align-items-center">
                          <a href="{{route('livraison.edit' ,$livraison->code_postal)}}" class="btn btn-warning m-2 btn-sm">
                              <i class="fas fa-edit "></i>
                          </a> 
                          <form id="{{$livraison->code_postal}}" action={{ route('livraison.destroy',$livraison->code_postal) }} method="post">
                              @csrf
                              @method("DELETE")
                                  <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                                  if(confirm('voulez vous supprimer la ville  {{ $livraison->ville }}?'))
                                      document.getElementById({{ $livraison->code_postal }}).submit();">
                                      <i class="material-icons">delete</i></button>
                          </form>
      
                        </td>
                          @endif
                    </tr>
                @endforeach
      
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection