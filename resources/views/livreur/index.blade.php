@extends('layouts.app', ['activePage' => 'Livreur', 'titlePage' => __('Ajouter Livreur')])

@section('content')
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> <b>Livreurs</b> <a href="{{ route('livreur.create') }}" class="btn btn-light" style="float: right">
              <i class="material-icons">add</i></a>
            </h4>
            <p class="card-category"> liste des livreurs</p>
          </div>
          <div class="card-body">
            
          <table class="table">
              <thead>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">Nom Livreur</th>
                  <th scope="col">Code Postal</th>
                  <th scope="col">Status</th>
                  <th scope="col">action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($livreurs as $livreur)
                    <tr>
                        <td>{{$livreur->id }}</td>
                        <td>{{$livreur->nom }}</td>
                        <td>{{$livreur->code_postal }}</td>
                        
                        <td> 
                          <input data-id="{{$livreur->id}}"
                           class="toggle-class" type="checkbox" data-onstyle="success"
                            data-offstyle="danger" data-toggle="toggle"
                             data-on="Active" data-off="InActive" {{ $livreur->status ? 'checked' : '' }}>
                        </td>
                         
                        <td class="d-flex flex-row justify-content-center align-items-center">
                          {{-- <a href="{{route('livreur.edit' ,$livreur->id)}}" class="btn btn-warning m-2 btn-sm">
                              <i class="fas fa-edit "></i>
                          </a> --}}
                          <form id="{{$livreur->id}}" action={{ route('livreur.destroy',$livreur->id) }} method="post">
                              @csrf
                              @method("DELETE")
                                  <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                                  if(confirm('voulez vous supprimer le livreur {{ $livreur->titre }}?'))
                                      document.getElementById({{ $livreur->id }}).submit();">
                                      <i class="material-icons">delete</i></button>
                          </form>
      
                        </td>
                          
                    </tr>
                @endforeach
      
              </tbody>
              <tfoot>
              <td  align="right">{{ $livreurs->links() }}</td>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection




@section('scripts')

<script>
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{route("livreur.changeStatusLivreur")}}',
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
@endsection