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
        $data = Client::select(\DB::raw('count(*) as visits'), \DB::raw("LPAD(CAST(EXTRACT(Month from created_at) AS VARCHAR), '2', '0') || '-' ||
        CAST(Extract(Year from created_at) AS VARCHAR) AS country"))
        ->groupBy(\DB::raw('country'))
        ->get();
        return response()->json($data);
    }

    /**
     * Função responsável por retornar Query para criação de Dashboard (Pedidos)
     *
     */
    public function dataDemands(){
        $data = Demand::select(\DB::raw('count(*) as litres, status_demands.description AS country'))
        ->join('status_demands', 'demands.status_demand_id', '=', 'status_demands.id')
        ->groupBy('status_demands.description')
        ->get();
        return response()->json($data);
    }

    /**
     * Função responsável por retornar Query para criação de Dashboard (Produtos)
     *
     */
    public function dataProducts(){
        $data = DemandxProduct::select(\DB::raw('products.name as title, count(*) as value'))
            ->join('products', 'demand_x_products.product_id', '=', 'products.id')
            ->groupBy('products.name')
            ->orderBy('value', 'DESC')
            ->limit(3)
            ->get();
        return response()->json($data);
    }
}