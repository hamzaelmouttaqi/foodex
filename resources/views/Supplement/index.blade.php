@extends('layouts.app', ['activePage' => 'supplement', 'titlePage' => __('supplement')])


@section('content')
    <div class="content">
      <div class="col-md-10 mx-auto">
        <div class="card">
          <div class="card-header card-header-primary">
            
              <h4 class="card-title "> <b>Supplement</b> <a href="{{ route('supplement.create') }}" class="btn btn-info" style="float: right">
                <i class="material-icons">add</i></a></h4>
              <p class="card-category"> liste des Supplement</p>
          </div>
        <div class="card-body">
        <table class="table">
            <thead>
              <tr style="text-align: center">
                <th scope="col">id</th>
                <th scope="col">Nom Supplement</th>
                <th scope="col">Prix</th>
                <th scope="col">Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($supplements as $supplement)
                  <tr style="text-align: center">
                      <td>{{$supplement->id }}</td>
                      <td><b>{{$supplement->titre }}</b></td>
                      <td>{{$supplement->prix }} DH</td>
                      <td>
                        <input data-id="{{$supplement->id}}" class="toggle-class"
                         type="checkbox" data-onstyle="success" data-offstyle="danger" 
                         data-toggle="toggle" data-on="Active"
                         data-off="InActive" {{ $supplement->status ? 'checked' : '' }}>  
                    
                        </td> 
                    
                      <td class="d-flex flex-row justify-content-center align-items-center">
                        <a href="{{route('supplement.edit' ,$supplement->id)}}" class="btn btn-warning m-2 btn-sm">
                            <i class="material-icons">edit</i>
                        </a>
                    
                        <form id="{{$supplement->id}}" action={{ route('supplement.destroy',$supplement->id) }} method="post">
                            @csrf
                            @method("DELETE")
                                <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                                if(confirm('voulez vous supprimer le Supplement {{ $supplement->titre }}?'))
                                    document.getElementById({{ $supplement->id }}).submit();">
                                    <i class="material-icons">delete</i></button>
                        </form>
    
                    </td>
                        
                  </tr>
              @endforeach
    
            </tbody>
            <tfoot>
              <td  align="right">{{ $supplements->links() }}</td>
              </tfoot>
          </table>
      </div>
    </div>
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
  
              url: '{{route("supplement.changeStatus")}}',
  
              data: {'status': status, 'id': id},
  
              success: function(data){
  
                console.log(data.success)
  
              }
  
          });
  
      })
  
    })
  
  </script>
@endsection