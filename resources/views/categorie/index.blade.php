@extends('layouts.app', ['activePage' => 'categorie', 'titlePage' => __('categorie')])

@section('content')
    <div class="content">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            
              <h4 class="card-title "> <b>Categories</b>
                @if (Auth::user()->hasRole('administrator'))
                 <a href="{{ route('categorie.create') }}" class="btn btn-info" style="float: right">
                <i class="material-icons">add</i></a>
                @endif
              </h4>

              <p class="card-category"> liste des categories</p>
          </div>
        <div class="card-body">
        <table class="table">
            <thead>
              <tr style="text-align: center">
                <th scope="col">id</th>
                <th scope="col">nom Categorie</th>
                <th scope="col">status</th>
                @if (Auth::user()->hasRole('administrator'))
                <th scope="col">Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($categorie as $categorie)
                  <tr style="text-align: center">
                    <td>{{$categorie ->id}}</td>
                    <td><b>{{ $categorie->nomCat }}</b></td>
                    <td>
                      <input data-id="{{$categorie->id}}"
                      class="toggle-class" type="checkbox" data-onstyle="success"
                       data-offstyle="danger" data-toggle="toggle"
                        data-on="Active" data-off="InActive" {{ $categorie->status ? 'checked' : '' }}>
                    
                    </td>                    
                    @if (Auth::user()->hasRole('administrator'))
                    <td class="d-flex flex-row justify-content-center align-items-center">
                     <a href="{{ route('categorie.edit',$categorie->id) }}" class="btn btn-warning mr-2 btn-sm">
                    <i class="material-icons">edit</i>
                    </a>
                    <form id="{{$categorie->id}}" action={{ route('categorie.destroy',$categorie->id) }} method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                            if(confirm('voulez vous supprimer la categorie {{ $categorie->nomCat }}?'))
                                document.getElementById({{ $categorie->id }}).submit();">
                                <i class="material-icons">delete</i></button>
                    </form>
                    </td>
                    @endif
                  </tr>
              @endforeach
            </tbody>
          </table>
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
            url: '/changeStatuss',
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
@endsection