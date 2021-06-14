@extends('layouts.app',['activePage' => 'Achat', 'titlePage' => __('Achat list')])

@section('content')
<div class="content ">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> <b>Achats</b> <a href="{{ route('achat.create') }}" class="btn btn-light" style="float: right">
              <i class="material-icons">add</i></a>
            </h4>
            <p class="card-category"> liste des achats</p>
          </div>
            
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">Nom Fournisseur</th>
                      <th scope="col">Date Achat</th>
                      <th scope="col">Prix</th>
                      <th scope="col"><center>action</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($achats as $achat)
                        <tr>
                            <td>{{$achat->id }}</td>
                            <td>{{$achat->fournisseur->nom }}</td>
                            
                            {{-- <td>
                              @foreach ($achat->alimentaires as $alim)
                                  
                              <table class="{{$achat->id}}{{$alim->id}}" style="display: none" >
                                <tr>
                                  <th scope="col">Composants</th>
                                  <th scope="col">Supplement</th>
                                </tr>
                                  <tr>
                                  <td width=120>
                                    @foreach (json_decode($alim->pivot->composantachat) as $comp)
                                     <li>{{$comp}}</li>
                                    @endforeach
                                  </td>
                                    <td width=85>
                                    @foreach (json_decode($alim->pivot->supplementachat) as $sup)
                                    <li>{{$sup}}</li>
                                    @endforeach
                                  </td>
                                </tr>
                                </table>
                              
                          @endforeach
                          
                        </td> --}}
                        <td>{{$achat->created_at}}</td>
                        <td>{{$achat->prix_total }} dh</td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                          
                          <form id="{{$achat->id}}" action={{ route('achat.destroy',$achat->id) }} method="post">
                              @csrf
                              @method("DELETE") 
                                  <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                                  if(confirm('voulez vous supprimer l achat {{ $achat->id }}?'))
                                      document.getElementById({{ $achat->id }}).submit();">
                                      <i class="material-icons">delete</i></button>
                          </form>
                          <a class="btn  btn-light btn-sm ml-2" href="{{ route('achat.show',$achat->id)}}" ><i class="material-icons">receipt_long</i></a>
                      </td>
                          
                    </tr>
                    @endforeach
      
                  </tbody>
                  <tfoot>
                    <td  align="right">{{ $achats->links() }}</td>
                  </tfoot>
              </table>
          
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection



