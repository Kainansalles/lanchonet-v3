<?php
/**
 * Class AdminDashBoard - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Client;
use App\Models\Demand;
use App\Models\DemandxProduct;

class DashboardController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        return view('dashboard');
    }

    public function dataClients(){
        $data = DemandxProduct::select(\DB::raw('sum(price_registred) as visits'), \DB::raw('DATE_FORMAT(created_at,\' %Y-%m\') AS "country"'))
        ->groupBy(\DB::raw('country'))
        ->get();
        return response()->json($data);
    }

    /**
     * Função responsável por retornar Query para criação de Dashboard (Pedidos)
     *
     */
    public function dataDemands(){
        $data = Demand::select(\DB::raw('count(*) as value, status_demands.description AS title'))
        ->join('status_demands', 'demands.status_demand_id', '=', 'status_demands.id')
        ->groupBy('demands.status_demand_id')
        ->get();
        return response()->json($data);
    }
}