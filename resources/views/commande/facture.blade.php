@extends('layouts.app' ,['activePage' => 'Commandelist', 'titlePage' => __('commande list')])
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-5">
            <div class="card" >
                <div class="card-header card-header-warning">
                    <h4 class="card-title "> <b>Facture</b> <a style="float: right" class="btn btn-light" onclick="printDiv('printableArea')" title="Print"><span class="fa fa-print"></span>
            
                    </a></h4>
                        
                </div>
                <div class="card-body" id="printableArea">
                    <div class="table-responsive m-b-20">

                        <table border="0" class="d-flex justify-content-center">

                        <tr>

                        <td>



                        <table border="0" width="100%">

                            <tr>

                                    <td align="center" style="border-bottom:2px #333 solid;"><span style="font-size: 17pt; font-weight:bold;">FOODEX</span><br>

                                    Adresse<br>

                                    0666666666
                                    </td>

                            </tr>

                            <tr>
                            @foreach ($commande as $comm)
                            <td align="center"><b>{{  $comm->nom_client }}</b><br>
                             
                                {{ DB::table('clients')->select('adresse')->where('id',$comm->id_client)->value('adresse') }}<br>
                                {{ DB::table('clients')->select('tele')->where('id',$comm->id_client)->value('tele') }}
                            </td>

                            </tr>

                            <tr>

                            <td align="center"><nobr><date>{{ $comm->created_at }}<time></nobr></td>

                            </tr>

                        </table>

                        <table width="100%">

                            <tr align="center">
                            
                            <th></th>

                            <th>Quntité</th> 

                            <th>Element</th>

                            <th>TAILLE</th>

                            <th align="right">PRIX</th>

                            {{-- <th align="right">TOTAL</th> --}}

                            </tr>
                            @foreach ($comm->alimentaires as $alim)
                            <tr>
                                <td></td>
                                <td align="center">x{{ $alim->pivot->quantite }}</td>
                                <td>{{ $alim->titre }}</td>
                                <td align="center">{{ $alim->pivot->sizeAlimentaire }}</td>
                                <td  align="center">{{ $alim->pivot->prixSize*$alim->pivot->quantite }} DH</td>
                            </tr>
                            <tr>    
                                <td></td>
                                <td></td>
                                <td  align="left">
                                @foreach (json_decode($alim->pivot->supplementCommande) as $supp)
            
                                        <li style="list-style-type: none;">
                                            +{{ $supp }}
                                        </li>
                                    
                                @endforeach
                                </td>
                                <td></td>
                                    <td align="center">{{ $alim->pivot->prixSupplement }} DH</td>
                            </tr>
                            @endforeach
                            <tr>

                                <td colspan="5" style="border-top:#333 1px solid;"><nobr></nobr></td>

                            </tr>  

                            <tr>
                                <td></td>

                                <td align="left"><nobr></nobr></td>

                                <td align="center" style="text-transform: uppercase"><nobr>Total</nobr></td>

                                <td align="center"><nobr> {{ $comm->montant }} DH</nobr></td>
                                <td></td>
                            </tr>

                            <tr>

                                <td colspan="5" style="border-top:#333 1px solid;"><nobr></nobr></td>

                            </tr>

                            <tr>

                            <td align="left"><nobr></nobr></td>

                            <td align="left" colspan="3"><nobr>Livraison</nobr></td>
                            @php
                                             $code_postal=DB::table('clients')->select('code_postal')->where('id',$comm->id_client)->value('code_postal');
                                             $prix=DB::table('livraisons')->select('prix')->where('code_postal',$code_postal)->value('prix') ;
                            @endphp

                            <td align="right"><nobr>{{ $prix }}DH</nobr></td>

                            </tr>
                            <tr>

                            <td align="left"><nobr></nobr></td>

                            <td align="left" colspan="3"><nobr>Frais de service</nobr></td>

                            <td align="right"><nobr> 0 DH</nobr></td>

                            </tr>

                            <tr>

                            <td align="left"><nobr></nobr></td>

                            <td align="left" colspan="3"><nobr>Remise</nobr></td>

                            <td align="right"><nobr>  0 DH</nobr></td>

                            </tr>

                            <tr>

                                <td colspan="5" style="border-top:#333 1px solid;"><nobr></nobr></td>

                            </tr>

                            <tr>

                            <td align="left"><nobr></nobr></td>

                            <td align="left" colspan="3"><nobr><strong>SOMME FINALE</strong></nobr></td>

                            <td align="right"><nobr>{{ $comm->montant + $prix }} DH</nobr></td>

                            </tr>

                            <tr>

                                <td colspan="5" style="border-top:#333 1px solid;"><nobr></nobr></td>

                            </tr>

                            <tr>

                                <td colspan="5" style="border-top:#333 1px solid;"><nobr></nobr></td>

                            </tr>

                        </table>

                        <table width="100%">

                            <tr>

                                <td>Le reçu  No:0225</td>

                                <td>Utilisateur: SAID ELBOUAZIZI</td>

                            </tr>

                        </table>

                        </td>

                        </tr>

                        <tr>

                        <td>Alimenté par:  www.foodex.com</td>

                        </tr>

                        </table>
                        </div>

                        </div>

        
        @endforeach
            </div>                
    
    
    
         </div>
    
    
    
   
        </div>
    </div>


@endsection

@section('scripts')
    @parent
    <script>
        function printDiv(divName) {

        var printContents = document.getElementById(divName).innerHTML;

        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        // document.body.style.marginTop="-45px";

        window.print();

        document.body.innerHTML = originalContents;
    }
    </script>
@endsection