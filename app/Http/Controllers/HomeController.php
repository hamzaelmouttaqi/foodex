<?php

namespace App\Http\Controllers;

use App\Models\alimentaire;
use App\Models\AlimentaireCommande;
use App\Models\Client;
use App\Models\Commande;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   

        $agoDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->subWeek();
        $agoDate=$agoDate->toDateTimeString();
        $agoMonth=Carbon::now()->subMonth();
        $agoMonth=$agoMonth->toDateString();
        $yesterday=Carbon::now()->subDay();
        $yesterday=$yesterday->toDateString();
        $montant=Commande::where('created_at','like','%'.date('Y-m-d').'%')->sum('montant');
        $montant_yesterday=Commande::where('created_at','like','%'.$yesterday.'%')->sum('montant');
        $clients=Client::whereBetween('created_at',[$agoDate,date('Y-m-d H:i:s')])->count('id');
        $alim_favo = DB::table('alimentaire_commande')
        ->select('alimentaire_id', DB::raw('COUNT(id) as alim'))
        ->groupBy('alimentaire_id')
        ->orderBy(DB::raw('COUNT(id)'), 'DESC')
        ->take(5)
        ->get();
        // $alim_defavo = DB::table('alimentaire_commande')
        // ->select('alimentaire_id', DB::raw('COUNT(id) as alim'))
        // ->groupBy('alimentaire_id')
        // ->orderBy(DB::raw('COUNT(id)'), 'ASC')
        // ->take(2)
        // ->get();
        $commandes_agomonth=Commande::whereYear('created_at','=',date('Y',strtotime($agoMonth)))
        ->whereMonth('created_at','=',date('m',strtotime($agoMonth)))
        ->count('id');
        $commandes_thismonth=Commande::whereYear('created_at','=',date('Y'))
        ->whereMonth('created_at','=',date('m'))
        ->count('id');
        if($commandes_agomonth!=0){
        $diff=$commandes_thismonth-$commandes_agomonth;
        $pourcent=$diff/$commandes_agomonth;
        $pourcent_commande=$pourcent*100;
        $pourcent_commande=number_format((float)$pourcent_commande, 2, '.', '');
        }
        else{
            $pourcent_commande=0;
        }
        if($montant_yesterday!=0){
            $diff=$montant-$montant_yesterday;
            $pourcent=$diff/$montant_yesterday;
            $pourcent_montant=$pourcent*100;
            $pourcent_montant=number_format((float)$pourcent_montant, 2, '.', '');
        }
        else{
            $pourcent_montant=0;
        }

        $client_agomonth=Commande::select('nom_client',DB::raw('count(id) as sale'))->
        whereYear('created_at','=',date('Y',strtotime($agoMonth)))
        ->whereMonth('created_at','=',date('m',strtotime($agoMonth)))
        ->groupBy('nom_client')->orderBy('sale','DESC')
        ->first();
        $clients_thismonth=Commande::select('nom_client',DB::raw('count(id) as sale'))->
        whereYear('created_at','=',date('Y'))
        ->whereMonth('created_at','=',date('m'))
        ->groupBy('nom_client')->orderBy('sale','DESC')
        ->limit(5)->get();
        
        // $clients_month=DB::select('select s.nom_client, count(s.id) as sale from commandes s 
        // where created_at=) group by s.nom_client order by sale desc');
        
        

        $data=DB::select('select p.id, count(s.id) as sale from alimentaires p
        left join alimentaire_commande s on p.id = s.alimentaire_id group by p.id order by sale');
        
        return view('dashboard',compact('montant','clients',
        'alim_favo','data','commandes_agomonth',
        'commandes_thismonth','pourcent_commande',
        'pourcent_montant','montant_yesterday','client_agomonth','clients_thismonth'))
        ->with(['alimentaires'=>alimentaire::count('id')
        ]);
    }
}
