@extends('layouts.app', ['activePage' => 'Avis', 'titlePage' => __('Avis')])

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
              <table class="table" style="text-align: center">
                <thead style="width: 200px">
                    <tr >
                        <th ><i class="fa fa-users fa-2x" aria-hidden="true"></i></th>
                        <th colspan="7" >Avis</th>
                            
                    </tr>
                </thead>
            </table>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">date</th>
                    <th scope="col">Nom</th>
                    <th scope="col">description</th>
                    <th scope="col">note</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($avis as $avis)
                      <tr>
                        <td>{{ $avis->created_at }}</td>
                        <td>{{ $avis->name }}</td>
                        <td>{{ $avis->description }}</td>
                        <td>{{ $avis->note }}</td>
                        
                        <form id="{{$avis->id}}" action={{ route('Avis.destroy',$avis->id) }} method="post">
                            @csrf
                            @method("DELETE")
                                <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                                if(confirm('voulez vous supprimer le client {{ $avis->nom }} ?'))
                                    document.getElementById({{ $avis->id }}).submit();">
                                    <i class="fas fa-trash"></i></button>
                        </form>
                        </td>
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
