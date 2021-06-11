@extends('layouts.app',['activePage' => 'Commandelist', 'titlePage' => __('commande list')])

@section('content')
<div class="content ">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> <b>Commandes</b> <a href="{{ route('commande.create') }}" class="btn btn-light" style="float: right">
              <i class="material-icons">add</i></a>
            </h4>
            <p class="card-category"> liste des commandes</p>
          </div>
            
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">Client</th>
                      <th scope="col">Status</th>
                      <th scope="col"><center>Elements de commande</center></th>
                      <th scope="col">Date commande</th>
                      <th scope="col">Montant</th>
                      <th scope="col">Livreur</th>
          
                      <th scope="col"><center>action</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($commandes as $commande)
                        <tr>
                            <td>{{$commande->id }}</td>
                            <td>{{$commande->nom_client }} {{$commande->prenomclient }}</td>
                            <td>
                              @if ($commande->status == '1')
                                  <button class="btn btn-danger">en cours</button> 
                              @else
                              <button class="btn btn-success">completé</button> 
                              @endif
                            </td>
                            
                              <td>
                                @foreach ($commande->alimentaires as $alim)
                                    
                                    <table class="table" border="0" border-collapse="collapse" >
                                      <tr>
                                        <td width=80>{{$alim->titre}}</td>
                                        <td width=80>({{$alim->pivot->sizeAlimentaire}}) </td> 
                                        <td width=80>Qte : {{$alim->pivot->quantite}}</td>
                                          
                                            <td>
                                              <table class="{{$commande->id}}{{$alim->id}}" style="display: none" >
                                                <tr>
                                                  <th scope="col">Composants</th>
                                                  <th scope="col">Supplement</th>
                                                </tr>
                                                <tr>
                                                  <td width=120>
                                                    @foreach (json_decode($alim->pivot->composantCommande) as $comp)
                                                     <li>{{$comp}}</li>
                                                    @endforeach
                                                  </td>
                                                  <td width=85>
                                                    @foreach (json_decode($alim->pivot->supplementCommande) as $sup)
                                                    <li>{{$sup}}</li>
                                                    @endforeach
                                                  </td>
                                                </tr>
                                              </table>
                                              
                                            </td>
                                            
                                            <td><button type="button" class="sh alim{{$commande->id}}{{$alim->id}}" style="border-radius: 25px" data-id="{{$commande->id}}{{$alim->id}}">+</button></td>
                                            <td><button type="button" class="ssh aalim{{$commande->id}}{{$alim->id}}"  data-id="{{$commande->id}}{{$alim->id}}" style="display: none ; border-radius: 25px">-</button></td>
                                      </tr>
                                    </table>
                                
                            @endforeach
                            
                          </td>
                          
                        
                        <td>{{$commande->created_at}}</td>
                        
                        
                        <td>{{$commande->montant }} dh</td>
                        <td>
                          {{DB::table('livreurs')->select('nom')->where('id',$commande->id_livreur)->value('nom')}}
                        </td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                          <a href="{{route('commande.edit' ,$commande->id)}}" class="btn btn-warning m-1 btn-sm">
                            <i class="material-icons">edit</i>
                          </a>
                          <form id="{{$commande->id}}" action={{ route('commande.destroy',$commande->id) }} method="post">
                              @csrf
                              @method("DELETE") 
                                  <button class="btn btn-danger btn-sm" onclick="javascript:event.preventDefault();
                                  if(confirm('voulez vous supprimer la commande {{ $commande->nomCat }}?'))
                                      document.getElementById({{ $commande->id }}).submit();">
                                      <i class="material-icons">delete</i></button>
                          </form>
                          @if ($commande->status == '1')
                          <button  data-id="{{$commande->id}}" class="toggle-class ml-2 btn btn-light btn-sm" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                              data-on="Active" data-off="InActive" {{ $commande->status ? 'checked' : '' }}>
                              <i class="material-icons">done</i>
                          </button>
                          
                          @endif
                          <a class="btn  btn-light btn-sm ml-2" href="{{ route('commande.show',$commande->id)}}" ><i class="material-icons">receipt_long</i></a>
                      </td>
                          
                    </tr>
                    @endforeach
      
                  </tbody>
                  <tfoot>
                    <td  align="right">{{ $commandes->links() }}</td>
                  </tfoot>
              </table>
          
            </div>
          </div>
        </div>
      </div>
    </div>
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
  
              url: '{{route("commande.changeStatut")}}',
  
              data: {'status': status, 'id': id},
  
              success: function(data){
  
                console.log(data.success);
                location.reload();
  
              }
          });
  
      })
    })

$(function() {
      $('.sh').on('click',function() {
        var id = $(this).data('id'); 
        $("."+id).show();
        $('.alim'+id).hide();
        $('.aalim'+id).show();
    })
      
    $('.ssh').on('click',function() {
        var id = $(this).data('id'); 
        $("."+id).hide();
        $('.aalim'+id).hide();
        $('.alim'+id).show();
    })
    })
  </script>
  
@endsection