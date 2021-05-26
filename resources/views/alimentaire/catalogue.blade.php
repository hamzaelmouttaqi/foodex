

@extends('layouts.app', ['activePage' => 'Menucatalogue', 'titlePage' => __('Menu Catalogue')])

@section('content')
    <div class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" >
              <h4 class="card-title"><h2 style="font-weight: 900;color:black">Catalogue<a href="{{ route('alimentaire.create') }}" class="btn btn-outline-warning" style="float: right">
                <i style="font-size:20px " class="material-icons md-48">add</i></a></h2>
                
              </h4>
              <p class="card-category"> catalogue des alimentaires</p>
            </div>
            <div class="card-body">
              <div class="row">
                  @foreach ($alimentaires as $alimentaire)
                  <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card">
                      
                        <img class="card-img-top" width='400' height='250' src="{{ asset('uploads/alimentaire/image/'. $alimentaire->image ) }}" alt="card_img">
                      
                      <div class="card-body ">
                        <div class="card-title">
                          <table>
                              <tr style="font-weight: 900">
                                  <td width='300px' style="text-transform: uppercase">
                                      <b>{{ $alimentaire->titre }}</b>
                                  </td>
                                  <td bgcolor="#ff9800" style="border-radius: 50%;width: 50px;color: black;font-weight: 900" align="center">
                                     {{ $alimentaire->categorie }}
                                  </td>
                              </tr>
                          </table>
                        </div>
                        <div class="card-text">
                          @php
                                    $desc=substr( $alimentaire->description ,0,150)
                           @endphp
                          {{ $desc}}...
                        </div>
                        <a href="#" class="btn btn-warning btn-md btn-block">See More</a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                
              </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    


@endsection