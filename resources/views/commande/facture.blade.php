@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-sm-12">

        <div class="panel panel-bd">

        <div class="panel-footer text-right">

                <a  class="btn btn-info" onclick="printDiv('printableArea')" title="Print"><span class="fa fa-print"></span>

                </a>

        </div>

        <div id="printableArea" style="position: absolute;left:25%;right:25%">

                <div class="panel-body">

                    <div class="table-responsive m-b-20">

                        <table border="0">

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
                            
                            

                                {{-- {{ $commande->clients->adresse }}<br>

                                {{ $commande->clients->tele }} --}}
                            </td>

                            </tr>

                            <tr>

                            <td align="center"><nobr><date>{{ $comm->created_at }}<time></nobr></td>

                            </tr>

                        </table>

                        <table width="100%">

                            <tr align="center">

                            <th>Quntité</th> 

                            <th>Element</th>

                            <th>TAILLE</th>

                            <th align="right">PRIX</th>

                            {{-- <th align="right">TOTAL</th> --}}

                            </tr>
                            @foreach ($comm->alimentaires as $alim)
                            <tr>
                                <td align="center">x{{ $alim->pivot->quantite }}</td>
                                <td>{{ $alim->titre }}</td>
                                <td align="center">{{ $alim->pivot->sizeAlimentaire }}</td>
                                <td>{{ $alim->pivot->prixAlimentaire }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                @foreach (json_decode($alim->pivot->supplementCommande) as $supp)
            
                                        <li style="list-style-type: none">
                                            {{ $supp }}
                                        </li>
                                    
                                @endforeach
                                </td>
                                    <td colspan="2" align="right">{{ $alim->pivot->prixSupplement }} DH</td>
                            </tr>
                            @endforeach
                            <tr>

                                <td colspan="3" style="border-top:#333 1px solid;"><nobr></nobr></td>

                            </tr>  

                            <tr>

                                <td align="left"><nobr></nobr></td>

                                <td align="left"><nobr>Total</nobr></td>

                                <td align="right"><nobr> {{ $comm->montant }}</nobr></td>

                            </tr>

                            <tr>

                                <td colspan="5" style="border-top:#333 1px solid;"><nobr></nobr></td>

                            </tr>

                            <tr>

                            <td align="left"><nobr></nobr></td>

                            <td align="left" colspan="3"><nobr>Impôt</nobr></td>

                            <td align="right"><nobr> 0 €</nobr></td>

                            </tr>
                            <tr>

                            <td align="left"><nobr></nobr></td>

                            <td align="left" colspan="3"><nobr>Frais de service</nobr></td>

                            <td align="right"><nobr> 2.9 €</nobr></td>

                            </tr>

                            <tr>

                            <td align="left"><nobr></nobr></td>

                            <td align="left" colspan="3"><nobr>Remise</nobr></td>

                            <td align="right"><nobr>  0 €</nobr></td>

                            </tr>

                            <tr>

                                <td colspan="5" style="border-top:#333 1px solid;"><nobr></nobr></td>

                            </tr>

                            <tr>

                            <td align="left"><nobr></nobr></td>

                            <td align="left" colspan="3"><nobr><strong>SOMME FINALE</strong></nobr></td>

                            <td align="right"><nobr><strong> 42.8 €</strong></nobr></td>

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