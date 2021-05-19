@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table" style="text-align: center">
            <thead style="width: 200px">
                <tr >
                    <th ><i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i></th>
                    <th colspan="7" >Commandes</th>
                    <th ><a href="{{ route('commande.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i></th>
                </tr>
            </thead>
        </table>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">client</th>
                <th scope="col">status</th>
                <th scope="col">date commande</th>
                <th scope="col">montant</th>
                <th scope="col">elements</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($commandes as $commande)
                  <tr>
                    <td>{{$commande ->id}}</td>
                    <td>{{ $commande->nom_client }}</td>
                    <td>@if ($commande->status=='1')
                        <button class="btn btn-danger">non complete</button>
                        @else
                        <button class="btn btn-success">complete</button>
                    @endif</td>
                    <td >{{ $commande->created_at }}</td>
                    <td>{{ $commande->montant }}</td>
                    <td>items</td>
                    <td class="d-flex flex-row justify-content-left align-items-left "><a href="{{ route('commande.edit',$commande->id) }}" class="btn btn-warning mr-2 mt-2 btn-sm">
                    <i class="fas fa-edit "></i>
                    </a>
                    <form id="{{$commande->id}}" action={{ route('commande.destroy',$commande->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm mt-2" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer l alimentaire {{ $commande->id }}?'))
                                document.getElementById({{ $commande->id }}).submit();">
                                <i class="fas fa-trash"></i></button>
                    </form>
                    @if ($commande->status=='1' )
                        {{-- <a href="{{ route('commande.changeStatus',$commande->id) }}" class="btn btn-info ml-2 mt-2 btn-sm">
                        <i class="fas fa-check "></i>
                        </a> --}}
                        <button class="toggle-class btn btn-info ml-2 mt-2 btn-sm" data-id="{{ $commande->id }}" type="button" data-toggle="toggle"
                            data-on="Active" data-off="InActive"><i class="fas fa-check "></i></button>
                        
                    @endif
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection
@section('scripts')
@parent
<script>

    $(function() {
      $('.toggle-class').on('click',function() {
  
          var status = 0; 
  
          var id = $(this).data('id'); 
  
          $.ajax({
  
              type: "GET",
  
              dataType: "json",
  
              url: '/changeStatut',
  
              data: {'status': status, 'id': id},
  
              success: function(data){
  
                console.log(data.success);
                location.reload();
              }
  
          });
  
      })
  
    })
  
  </script>
@endsection