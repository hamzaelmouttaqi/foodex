@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table" style="text-align: center">
        <thead>
            <tr>
                <th><i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i></th>
                <th colspan="7">Livreur</th>
                <th><a href="{{route('livreur.create')}}" class="btn btn-primary">
                    <i class="fas fa-plus"></i></th>
            </tr>
        </thead>
    </table>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nom</th>
            <th scope="col">Code Postal</th>
            <th scope="col">Status</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($livreurs as $livreur)
              <tr>
                  <td>{{$livreur->id }}</td>
                  <td>{{$livreur->nom }}</td>
                  <td>{{$livreur->code_postal }}</td>
                  <td>
                    <input data-id="{{$livreur->id}}" class="toggle-class"
                     type="checkbox" data-onstyle="success" data-offstyle="danger" 
                     data-toggle="toggle" data-on="Active"
                     data-off="InActive" {{ $livreur->status ? 'checked' : '' }}>  
                
                    </td> 
                
                  <td class="d-flex flex-row justify-content-left align-items-center">
                   
                
                    <form id="{{$livreur->id}}" action={{ route('livreur.destroy',$livreur->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer le livreur {{ $livreur->nom }}?'))
                                document.getElementById({{ $livreur->id }}).submit();">
                                <i class="fas fa-trash"></i></button>
                    </form>

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
  
      $('.toggle-class').change(function() {
  
          var status = $(this).prop('checked') == true ? 1 : 0; 
  
          var id = $(this).data('id'); 
  
           
  
          $.ajax({
  
              type: "GET",
  
              dataType: "json",
  
              url: '/changeStatusLivreur',
  
              data: {'status': status, 'id': id},
  
              success: function(data){
  
                console.log(data.success)
  
              }
  
          });
  
      })
  
    })
  
  </script>
@endsection