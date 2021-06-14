@extends('layouts.app' ,['activePage' => 'Achat', 'titlePage' => __('achat list')])
@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">    
            
                <div class="card" >
                    <div class="card-header card-header-warning">
                        <h4 class="card-title "> <b>Facture</b> <a style="float: right" class="btn btn-light" onclick="printDiv('printableArea')" title="Print"><span class="fa fa-print"></span>
                
                        </a></h4>
                            
                    </div>
                    <div class="card-body" id="printableArea">
        
                            <div class="table-responsive m-b-50" >
                                <table style="border-color: black" border="1" width="100%" border-collapse = "collapse">
                                    <tr style="height: 50px">
                                        <th colspan="5"  style="text-align: center">
                                            <strong>BON D'ACHAT</strong>   
                                        </th>
                                    </tr>
                                    @foreach ($achat as $achat)
                                    <tr style="border-style: none; height: 200px">
                                        <td align="center" width="20%">
                                            <h4><strong>FOODEX</strong></h4>
                                            <h6>0555555555</h6>
                                            <h6>adresse foodex</h6>
                                        </td>
                                        <td colspan="3"></td>
                                        <td align="center" width="20%">
                                            <h4><strong>{{$achat->fournisseur->nom}}</strong></h4>
                                            @php
                                                $adresse = DB::table('fournisseurs')->select('adresse')->where('id',$achat->fournisseur_id)->value('adresse');
                                                $tele = DB::table('fournisseurs')->select('tele')->where('id',$achat->fournisseur_id)->value('tele');
                                            @endphp
                                            <h6>{{$tele}}</h6>
                                            <h6>{{$adresse}}</h6>
                                        </td>
                                    </tr>
                                </table>
                                    
                                <table style="border-color: black ; border-top: none " border="1" width="100%">
                                    <tr style="height: 50px">
                                        <th>REF</th>
                                        <TH style="text-align: right">QUANTITE</TH>
                                        <TH style="text-align: right">PRIX UNITAIRE</TH>
                                        <TH style="text-align: right">REMISE</TH>
                                        <TH style="text-align: right">TOTAL HT</TH>
                                        <TH style="text-align: right">TVA</TH>
                                        <TH style="text-align: right">TOTAL TTC</TH>
                                    </tr>
                                    @foreach ($achat->produits as $prod)
                                        <tr style="height: 50px">
                                            <td>{{ $prod->titre }}</td>
                                            <td align="right">x{{$prod->pivot->quantite}}</td>
                                            @php
                                                $prixUnitaire = DB::table('fournisseur_produit')->select('prix_unitaire')->where('produit_id',$prod->id)->value('prix_unitaire');
                                            @endphp
                                            <td align="right">{{$prixUnitaire}} DHs</td>
                                            <td align="right">0.00 %</td>{{--remise a ajouter --}}
                                            <td align="right">{{$prod->pivot->prix}} DHs</td>
                                            <td align="right">0.00 %</td>{{--tva a ajouter --}}
                                            <td align="right">{{$prod->pivot->prix /* -*tva */}} DHs</td>
                                        </tr>
                                    @endforeach
                                    <tr >
                                        <td colspan="3" style="border-bottom: none"></td>
                                        
                                        <td align="right"><strong>Total : </strong></td>
                                        <td align="right">
                                            {{$achat->prix_total}} DHs
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            {{$achat->prix_total}} DHs
                                        </td>
                                    </tr>
                                </table>
                                {{-- <table style="border-color: black" border="1" width="100%">
                                    <tr>
                                        <td colspan="5" align="right">
                                            {{$achat->prixTotal}} DHs
                                        </td>
                                    </tr>
                                </table> --}}
                            </div>
        
                        </div>
        
                </div>
            @endforeach
    
    
    
    
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