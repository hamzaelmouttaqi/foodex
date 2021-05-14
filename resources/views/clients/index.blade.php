@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table" style="text-align: center">
            <thead style="width: 200px">
                <tr >
                    <th ><i class="fa fa-users fa-2x" aria-hidden="true"></i></th>
                    <th colspan="7" >Clients</th>
                    <th ><a href="{{ route('clients.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i></th>
                </tr>
            </thead>
        </table>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">date de naissance</th>
                <th scope="col">email</th>
                <th scope="col">tele</th>
                <th scope="col">code postal</th>
                <th scope="col">adresse</th>
                <th scope="col">action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clients as $clients)
                  <tr>
                    <td>{{$clients->id}}</td>
                    <td>{{ $clients->nom }}</td>
                    <td>{{ $clients->Prenom }}</td>
                    <td>{{ $clients->date_de_naissance }}</td>
                    <td>{{ $clients->email }}</td>
                    <td>{{ $clients->tele }}</td>
                    <td>{{ $clients->code_postal }}</td>
                    <td>{{ $clients->adresse }}</td>
                    <td class="d-flex flex-row justify-content-center align-items-center">  <a href="{{ route('clients.edit',$clients->id) }}" class="btn btn-warning mr-2 btn-sm">
                    <i class="fas fa-edit "></i>
                    </a>
                    <form id="{{$clients->id}}" action={{ route('clients.destroy',$clients->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer le client {{ $clients->nom }} {{ $clients->Prenom }}?'))
                                document.getElementById({{ $clients->id }}).submit();">
                                <i class="fas fa-trash"></i></button>
                    </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection