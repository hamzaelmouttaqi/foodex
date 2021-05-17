@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table" style="text-align: center">
            <thead style="width: 200px">
                <tr >
                    <th ><i class="fa fa-utensils fa-2x" aria-hidden="true"></i></th>
                    <th colspan="7" >Alimentaires</th>
                    <th ><a href="{{ route('alimentaire.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i></th>
                </tr>
            </thead>
        </table>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">categorie</th>
                <th scope="col">titre</th>
                <th scope="col">image</th>
                <th scope="col">description</th>
                <th scope="col">composants</th>
                <th scope="col">sizes</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($alimentaire as $alimentaire)
                  <tr>
                    <td>{{$alimentaire ->id}}</td>
                    <td>{{$alimentaire->categorie }}</td>
                    <td>{{ $alimentaire->titre }}</td>
                    <td ><img class="fluid" width="60" height="60" src="{{ asset('uploads/alimentaire/image/'. $alimentaire->image ) }}" alt="" class="img-thumbnail"></td>
                    <td>{{ $alimentaire->description }}</td>
                    <td>@foreach ($alimentaire->composants as $composants)
                        <li>{{ $composants->nomComposant }}</li>
                    @endforeach</td>
                    <td align="left">
                      
                        @foreach ($alimentaire->sizes as $size)
                            <li style="list-style-type: none">{{ $size->title }}-{{ $size->pivot->prix }}</li>
                        @endforeach
                      

                    </td>
                    <td class="d-flex flex-row justify-content-left align-items-left">  <a href="{{ route('alimentaire.edit',$alimentaire->id) }}" class="btn btn-warning mr-2 btn-sm">
                    <i class="fas fa-edit "></i>
                    </a>
                    <form id="{{$alimentaire->id}}" action={{ route('alimentaire.destroy',$alimentaire->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer l alimentaire {{ $alimentaire->titre }}?'))
                                document.getElementById({{ $alimentaire->id }}).submit();">
                                <i class="fas fa-trash"></i></button>
                    </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection