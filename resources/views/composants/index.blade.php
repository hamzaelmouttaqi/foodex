@extends('layouts.app', ['activePage' => 'composants', 'titlePage' => __('composants')])

@section('content')
    <div class="content">
      <div class="col-md-10 mx-auto">
        <div class="card">
          <div class="card-header card-header-primary">
            
              <h4 class="card-title "> <b>Composants</b> <a href="{{ route('composants.create') }}" class="btn btn-info" style="float: right">
                <i class="material-icons">add</i></a></h4>
              <p class="card-category"> liste des composants</p>
          </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr style="text-align: center">
                <th scope="col">id</th>
                <th scope="col">Nom Composants</th>
                <th scope="col">image</th>
                <th scope="col">Prix</th>
                <th scope="col">categorie</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($composants as $composants)
                  <tr style="text-align: center">
                    <td>{{$composants ->id}}</td>
                    <td><strong>{{ $composants->nomComposant }}</strong></td>
                    <td ><img  width="80" height="60" src="{{ asset('uploads/composants/image/'. $composants->image ) }}" alt="" class="img-thumbnail"></td>
                    <td><pre>{{ $composants->prix }}  DH</pre></td>
                    <td>{{ $composants->categorie }}</td>
                    <td class="d-flex flex-row justify-content-center align-items-center">  <a href="{{ route('composants.edit',$composants->id) }}" class="btn btn-warning mr-2 btn-sm">
                    <i class="material-icons">edit</i>
                    </a>
                    <form id="{{$composants->id}}" action={{ route('composants.destroy',$composants->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer l composants {{ $composants->nomComposant }}?'))
                                document.getElementById({{ $composants->id }}).submit();">
                                <i class="material-icons">delete</i></button>
                    </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
      </div>
        </div>
    </div>
@endsection
