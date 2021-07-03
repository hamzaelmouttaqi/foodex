@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
          
          <div class="header-body">
            <div class="row">
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Clients de mois</h5>
                        @if ($client_agomonth!=null)
                        <span class="h2 font-weight-bold mb-0">{{ $client_agomonth->nom_client }}</span>
                        @endif
                        
                      </div>
                      <div class="col-auto">
                        <div class="icon">
                          <i class="material-icons" style="font-size: 30px ; color: green">celebration</i>
                        </div>
                      </div>
                    </div>
                    <center>
                      @if ($client_agomonth!=null)
                      <p class="mt-3 mb-0 text-muted text-sm">
                      
                        <span class="text-nowrap">{{ $client_agomonth->sale }} Commandes</span>
                      </p>
                      @endif
                    </center>
                    
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Nouveaux Clients</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $clients }}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon ">
                          <i class="material-icons" style="font-size: 30px ; color: red">person</i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-nowrap">This week</span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Ventes</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $montant }}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon">
                          <i class="material-icons" style="font-size: 30px ; color: orange">attach_money</i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      @php
                      if($montant>=$montant_yesterday){
                        $y=$pourcent_montant;
                      }
                      elseif ($montant<$montant_yesterday){
                        $y=100-$pourcent_montant;
                      }
                       @endphp
                          @if ($y==$pourcent_montant)
                      <span class=" mr-2 " style="color: orange" ><i class="fas fa-arrow-up" style="color: orange"></i>{{ $y }}%</span>
                      <span class="text-nowrap">Since yesterday</span>
                         @elseif($y==100-$pourcent_montant)
                      <span class=" mr-2 " style="color: orange" ><i class="fas fa-arrow-down" style="color: orange"></i>{{ $y }}%</span>
                      <span class="text-nowrap">Since yesterday</span>
                          @endif
                      
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Commandes</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $commandes_thismonth }}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon">
                          <i class="material-icons" style="font-size: 30px ; color: blue">pie_chart</i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm " >
                      @php
                          if($commandes_thismonth>=$commandes_agomonth){
                            $x=$pourcent_commande;
                          }
                          elseif ($commandes_thismonth<$commandes_agomonth){
                            $x=100-$pourcent_commande;
                          }
                      @endphp
                      @if ($x==$pourcent_commande)
                        <span class=" mr-2 " style="color: blue" ><i class="fas fa-arrow-up" style="color: blue"></i>{{ $x }}%</span>
                        <span class="text-nowrap">Since last month</span>
                      @elseif($x==100-$pourcent_commande)
                        <span class=" mr-2 " style="color: blue" ><i class="fas fa-arrow-down" style="color: blue"></i>{{ $x }}%</span>
                        <span class="text-nowrap">Since last month</span>
                      @endif
                      
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="margin-top:40px;">
              <div class="col-xl-6 col-lg-12" style="height:460px;overflow:scroll">
                <div class="card">
                  <div class="card-header  card-header-warning">
                    <center>
                      <h4 class="card-title "> <b> LES ALIMENTAIRES LES PLUS COMMANDES</b>
                        <i class="far fa-grin fa-lg"></i>
                      </h4>  
                    </center>
                  </div>
                  <div class="card-body">
                    @foreach ($alim_favo as $item)
                        @php
                            $alim=DB::table('alimentaires')->select('image','titre','categorie')->where('id',$item->alimentaire_id)->get();
                       @endphp
                      <div class="row">
                        @foreach ($alim as $itm)
                        <div class="col-md-4" style="margin-bottom: 10px">
                          <img width="150" height="150" src="{{ asset('uploads/alimentaire/image/'.$itm->image) }}" class="img-fluid" alt="">
                       </div>
                       <div class="col-md-4" style="margin-top: 5%">
                        <center>
                          <h4><b>{{ $itm->titre }}</b></h4>
                        </center>
                        </div>
                        <div class="col-md-4" style="margin-top: 5%">
                          <center>
                            <h5><b>{{ $itm->categorie }}</b></h5>
                          </center> 
                        </div>
                      </div>
                        @endforeach
                    @endforeach
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-12" style="height:460px;overflow:scroll">
              <div class="card">
                <div class="card-header card-header-primary">
                  <center>
                    <h4 class="card-title "> <b> LES ALIMENTAIRES LES MOINS COMMANDES</b>
                      <i class="far fa-frown-open fa-lg"></i>
                    </h4>  
                  </center>
                </div>
                <div class="card-body">
                  @foreach ($data as $item)
                  @if ($item->sale<=2)
                  @php
                  $alim=DB::table('alimentaires')->select('image','titre','categorie')->where('id',$item->id)->get();
             @endphp
            <div class="row">
              @foreach ($alim as $itm)
              <div class="col-md-4" style="margin-bottom: 10px">
                <img width="150" height="150" src="{{ asset('uploads/alimentaire/image/'.$itm->image) }}" class="img-fluid" alt="">
             </div>
             <div class="col-md-4" style="margin-top: 5%">
              <center>
                <h4><b>{{ $itm->titre }}</b></h4>
              </center>
              </div>
              <div class="col-md-4" style="margin-top: 5%">
                <center>
                  <h5><b>{{ $itm->categorie }}</b></h5>
                </center> 
              </div>
            </div>
              @endforeach
                  @endif
                      
                  @endforeach
              </div>
            </div>
          </div>
          </div>
          <div class="row" style="margin-top: 40px">
            <div class="col-xl-6 col-lg-12" >
              <div class="card">
                <div class="card-header  card-header-danger">
                  <center>
                    <h4 class="card-title "> <b> LES CLIENTS LES PLUS ACTIVES</b>
                      <i class="fas fa-user-friends"></i>
                    </h4>  
                  </center>
                </div>
                <div class="card-body">
                  <table class="table">
                    @foreach ($clients_thismonth as $clients)
                   <tr>
                     <td>
                       <img width="100px" height="100px" src="{{ asset('uploads/profil/default.png') }}" class="rounded-circle" alt="">
                     </td>
                     <td style="font-weight: bold;font-size:20px">
                       {{ $clients->nom_client }}
                     </td>
                     <td style="font-weight: bold;font-size:20px">
                       {{ $clients->sale }}
                     </td>
                   </tr>
                  @endforeach
                  </table>
                  
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
</div>
@endsection