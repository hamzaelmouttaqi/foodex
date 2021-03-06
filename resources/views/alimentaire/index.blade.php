

@extends('layouts.app', ['activePage' => 'Menulist', 'titlePage' => __('Menu list')])

@section('content')
    <div class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title "> <b>Alimentaires</b> 
                @if (Auth::user()->hasRole('administrator'))
                <a href="{{ route('alimentaire.create') }}" class="btn btn-light" style="float: right">
                <i class="material-icons">add</i></a>
                @endif
              </h4>
              <p class="card-category"> liste des alimentaires</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table w-100 "  >
                      <thead>
                        <tr style="text-align: left">
                          <th scope="col">id</th>
                          <th scope="col">Titre</th>
                          <th scope="col">Categorie</th>
                          <th scope="col">Image</th>
                          <th scope="col">Description</th>
                          <th scope="col">Composant</th>
                          <th scope="col">Sizes</th>
                          @if (Auth::user()->hasRole('administrator'))
                          <th>Action</th>
                          @endif
                          
                        </tr>
                      </thead>
                      <tbody >
                        @foreach ($alimentaires as $alimentaire)
                            <tr style="text-align: left" valign='top'>
                                <td>{{$alimentaire->id }}</td>
                                <td>{{$alimentaire->titre }}</td>
                                <td>{{$alimentaire->categorie }}</td>
                                <td  ><img width="200" height="200" src="{{ asset('uploads/alimentaire/image/'. $alimentaire->image ) }}" alt="" class="img-thumbnail"></td>
                                @php
                                    $desc=substr( $alimentaire->description ,0,100)
                                @endphp
                                <td width='300' height='100'>{{ $desc }}...</td>
                                
                                <td width='200'>
                                  @foreach ($alimentaire->composants as $composant)
                                    <li>{{ $composant->nomComposant }}</li>
                                  @endforeach
                                </td>
                                </td>
                                <td width='150'>
                                    @foreach ($alimentaire->sizes as $size)
                                      <li>{{ $size->title }} : {{ $size->pivot->prix}}</li>
                                    @endforeach                                 
                                </td>
                                @if (Auth::user()->hasRole('administrator'))
                                <td class="d-flex flex-row justify-content-center align-items-center">
                                  <a href="{{route('alimentaire.edit' ,$alimentaire->id)}}" class="btn btn-warning m-2 btn-sm">
                                      <i class="material-icons">edit</i>
                                  </a>
                                  <form id="{{$alimentaire->id}}" action={{ route('alimentaire.destroy',$alimentaire->id) }} method="post">
                                      @csrf
                                      @method("DELETE")
                                          <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                                          if(confirm('voulez vous supprimer l\'alimentaire {{ $alimentaire->titre }}?'))
                                              document.getElementById({{ $alimentaire->id }}).submit();">
                                              <i class="material-icons">delete</i></button>
                                  </form>
                                  
                              </td>
                                  @endif
                            </tr>
                        @endforeach
              
                      </tbody>
                      <tfoot>
                        <td  align="right">{{ $alimentaires->links() }}</td>
                      </tfoot>
                    </table>
                  
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


@endsection