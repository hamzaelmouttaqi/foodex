@extends('layouts.app', ['activePage' => 'categorie', 'titlePage' => __('categorie')])

@section('content')
    <div class="content">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            
              <h4 class="card-title "> <b>Categories</b> <a href="{{ route('categorie.create') }}" class="btn btn-info" style="float: right">
                <i class="material-icons">add</i></a></h4>
              <p class="card-category"> liste des categories</p>
          </div>
        <div class="card-body">
        <table class="table">
            <thead>
              <tr style="text-align: center">
                <th scope="col">id</th>
                <th scope="col">nom Categorie</th>
                <th scope="col">status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categorie as $categorie)
                  <tr style="text-align: center">
                    <td>{{$categorie ->id}}</td>
                    <td><b>{{ $categorie->nomCat }}</b></td>
                    <td>
                      @if ( $categorie->status )
                        <button class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></button>
                      @else
                      <button class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                      @endif
                    
                    
                    </td>                    
                    <td class="d-flex flex-row justify-content-center align-items-center">  <a href="{{ route('categorie.edit',$categorie->id) }}" class="btn btn-warning mr-2 btn-sm">
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
                  </tr>
              @endforeach
            </tbody>
          </table>
      </div>
        </div>
    </div>
@endsection