@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table" style="text-align: center">
            <thead style="width: 200px">
                <tr >
                    <th ><i class="fa fa-utensils fa-2x" aria-hidden="true"></i></th>
                    <th colspan="7" >Composants</th>
                    <th ><a href="{{ route('composants.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i></th>
                </tr>
            </thead>
        </table>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Nom Composants</th>
                <th scope="col">image</th>
                <th scope="col">categorie</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($composants as $composants)
                  <tr>
                    <td>{{$composants ->id}}</td>
                    <td>{{ $composants->nomComposant }}</td>
                    <td ><img class="fluid" width="60" height="60" src="{{ asset('uploads/composants/image/'. $composants->image ) }}" alt="" class="img-thumbnail"></td>
                    <td>{{ $composants->categorie }}</td>
                    <td class="d-flex flex-row justify-content-left align-items-left">  <a href="{{ route('composants.edit',$composants->id) }}" class="btn btn-warning mr-2 btn-sm">
                    <i class="fas fa-edit "></i>
                    </a>
                    <form id="{{$composants->id}}" action={{ route('composants.destroy',$composants->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer l composants {{ $composants->nomComposant }}?'))
                                document.getElementById({{ $composants->id }}).submit();">
                                <i class="fas fa-trash"></i></button>
                    </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection