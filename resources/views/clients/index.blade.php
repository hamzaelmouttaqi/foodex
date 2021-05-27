@extends('layouts.app', ['activePage' => 'client-liste', 'titlePage' => __('Clients')])

@section('content')
    <div class="content">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> <b>Clients</b> <a href="{{ route('clients.create') }}" class="btn btn-info" style="float: right">
              <i class="material-icons">add</i></a></h4>
            <p class="card-category"> liste des clients</p>
            
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr style="text-align: center">
                    <th scope="col"></th>
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
                  @foreach ($client as $clients)
                      <tr style="text-align: center">
                        <td>{{$clients->id}}</td>
                        <td>{{ $clients->nom }}</td>
                        <td>{{ $clients->Prenom }}</td>
                        <td>{{ $clients->date_de_naissance }}</td>
                        <td>{{ $clients->email }}</td>
                        <td>{{ $clients->tele }}</td>
                        <td>{{ $clients->code_postal }}</td>
                        <td>{{ $clients->adresse }}</td>
                        <td class="d-flex flex-row justify-content-center align-items-center">  <a href="{{ route('clients.edit',$clients->id) }}" class="btn btn-warning mr-2 btn-sm">
                        <i class="material-icons">edit</i>
                        </a>
                        <form id="{{$clients->id}}" action={{ route('clients.destroy',$clients->id) }} method="post">
                            @csrf
                            @method("DELETE")
                                <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                                if(confirm('voulez vous supprimer le client {{ $clients->nom }} {{ $clients->Prenom }}?'))
                                    document.getElementById({{ $clients->id }}).submit();">
                                    <i class="material-icons">delete</i></button>
                        </form>
                        </td>
                      </tr>
                  @endforeach
                  <tr>
                    
                  </tr>
                </tbody>
                <tfoot>
                  <td></td><td></td><td></td><td></td>
                  <td></td><td></td><td></td><td></td>
                <td  align="right">{{ $client->links() }}</td>
                </tfoot>
              </table> 
            </div>
          </div>
          
        </div>
        
      </div>
      
    </div>
    
@endsection