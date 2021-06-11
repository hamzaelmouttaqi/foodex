@extends('layouts.app', ['activePage' => 'employe', 'titlePage' => __('Employes')])

@section('content')
    <div class="content">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> <b>Employes</b> <a href="{{ route('register') }}" class="btn btn-info" style="float: right">
              <i class="material-icons">add</i></a></h4>
            <p class="card-category"> liste des Employes</p>
            
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr style="text-align: center">
                    <th scope="col"></th>
                    <th scope="col">Nom</th>
                    <th scope="col">email</th>
                    <th scope="col">fonction</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                      <tr style="text-align: center">
                        <td>{{$user->id}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                            {{ $role->name }}
                            @endforeach
                        </td>
                        <td class="d-flex flex-row justify-content-center align-items-center"> 
                        <form id="{{$user->id}}" action={{ route('employe.destroy', $user->id ) }} method="post">
                            @csrf
                            @method("DELETE")
                                <button class="btn btn-danger btn-sm"  onclick="javascript:event.preventDefault();
                                if(confirm('voulez vous supprimer le users {{ $user->name }}?'))
                                    document.getElementById({{ $user->id }}).submit();">
                                    <i class="material-icons">delete</i></button>
                        </form>
                        </td>
                      </tr>
                  @endforeach
                  <tr>
                    
                  </tr>
                </tbody>
                <tfoot>
                  <td></td><td></td><td></td><td></td>
                  <td></td><td></td><td></td><td></td>
                <td  align="right">{{ $users->links() }}</td>
                </tfoot>
              </table> 
            </div>
          </div>
          
        </div>
        
      </div>
      
    </div>
    
@endsection