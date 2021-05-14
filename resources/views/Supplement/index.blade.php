@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table" style="text-align: center">
        <thead>
            <tr>
                <th><i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i></th>
                <th colspan="7">supplements</th>
                <th><a href="{{route('supplement.create')}}" class="btn btn-primary">
                    <i class="fas fa-plus"></i></th>
            </tr>
        </thead>
    </table>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nom Supplement</th>
            <th scope="col">Prix</th>
            <th scope="col">Status</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($supplement as $supplement)
              <tr>
                  <td>{{$supplement->id }}</td>
                  <td>{{$supplement->titre }}</td>
                  <td>{{$supplement->prix }}</td>
                  <td>
                    <input data-id="{{$supplement->id}}" class="toggle-class"
                     type="checkbox" data-onstyle="success" data-offstyle="danger" 
                     data-toggle="toggle" data-on="Active"
                     data-off="InActive" {{ $supplement->status ? 'checked' : '' }}>  
                
                    </td> 
                
                  <td class="d-flex flex-row justify-content-left align-items-center">
                    <a href="{{route('supplement.edit' ,$supplement->id)}}" class="btn btn-warning m-2 btn-sm">
                        <i class="fas fa-edit "></i>
                    </a>
                
                    <form id="{{$supplement->id}}" action={{ route('supplement.destroy',$supplement->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer le Supplement {{ $supplement->titre }}?'))
                                document.getElementById({{ $supplement->id }}).submit();">
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
  
              url: '/changeStatus',
  
              data: {'status': status, 'id': id},
  
              success: function(data){
  
                console.log(data.success)
  
              }
  
          });
  
      })
  
    })
  
  </script>
@endsection