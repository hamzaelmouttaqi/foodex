@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table" style="text-align: center">
            <thead style="width: 200px">
                <tr >
                    <th ><i class="fa fa-utensils fa-2x" aria-hidden="true"></i></th>
                    <th colspan="7" >Categories</th>
                    <th ><a href="{{ route('categorie.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i></th>
                </tr>
            </thead>
        </table>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">nom Categorie</th>
                <th scope="col">status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categorie as $categorie)
                  <tr>
                    <td>{{$categorie ->id}}</td>
                    <td>{{ $categorie->nomCat }}</td>
                    <td>
                      @if ( $categorie->status )
                        <button class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></button>
                      @else
                      <button class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                      @endif
                    
                    
                    </td>                    
                    <td class="d-flex flex-row justify-content-center align-items-center">  <a href="{{ route('categorie.edit',$categorie->id) }}" class="btn btn-warning mr-2 btn-sm">
                    <i class="fas fa-edit "></i>
                    </a>
                    <form id="{{$categorie->id}}" action={{ route('categorie.destroy',$categorie->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer la categorie {{ $categorie->nomCat }}?'))
                                document.getElementById({{ $categorie->id }}).submit();">
                                <i class="fas fa-trash"></i></button>
                    </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection