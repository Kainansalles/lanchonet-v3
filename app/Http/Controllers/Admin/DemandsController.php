<?php
/**
 * Class Demands - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

//Models
use App\Models\Demand;
use App\Models\StatusDemand;

class DemandsController extends Controller
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
        return view('demands')->with([
            'statusDemands' => StatusDemand::get(['id', 'initials', 'description'])
            //'demand' => $this->getDatalistDemands()
        ]);
    }

    /**
     * Método responsavel por retornar os pedidos pro admin
     *@return JSON
     */
    public function getAllDemands(){
        $model = Demand::with(['client' ,'status_demand'])->whereIn('status_demand_id', [4])->get();
        return DataTables::collection($model)
            ->addColumn('action', function ($model) {
                return "
                <button class='btn btn-primary view_demand' id='" . $model->id . "' style='margin-right:3px;'><span class='fa fa-search'></span></button>
                <button class='btn btn-success confirm_demand' id='" . $model->id . "' style='margin-right:3px;'><span class='fa fa-check'></span></button>
                <button class='btn btn-danger cancel_demand' id='" . $model->id ."'><span class='fa fa-trash'></span></button>";
            })
            ->toJson();
    }

    /**
     * Método responsavel por retornar os 4 proximos pedidos
     *@return JSON
     */
    public function getListDemands(){
        $demands = $this->getDatalistDemands();
        if(!empty($demands)){
            return response()->json([
                'success' => true,
                'data' => $demands,
                'view' => view('layouts.demands-list')->with(['demands' => $demands ])->render(),
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }

    private function getDatalistDemands(){
        return Demand::with(['client' ,'status_demand', 'demand_x_product', 'demand_x_product.product'])
        ->whereIn('status_demand_id', [4])
        ->orderBy('hour_recall', 'DESC')
        ->limit(4)
        ->get();
    }

    /**
     * Método responsavel por retornar os pedidos por status específico
     *@return JSON
     */
    public function consultDemands($id){
        $model = Demand::with(['client' ,'status_demand'])->whereIn('status_demand_id', [$id])->get();
        return  DataTables::collection($model)
            ->addColumn('action', function ($model) {
                if($model->status_demand->allows_low){
                    return "
                    <button class='btn btn-primary view_demand' id='" . $model->id . "' style='margin-right:3px;'><span class='fa fa-search'></span></button>
                    <button class='btn btn-success confirm_demand' id='" . $model->id . "' style='margin-right:3px;'><span class='fa fa-check'></span></button>
                    <button class='btn btn-danger cancel_demand' id='" . $model->id ."'><span class='fa fa-trash'></span></button>";
                }
                return "
                <button class='btn btn-primary view_demand' id='" . $model->id . "' style='margin-right:3px;'><span class='fa fa-search'></span></button>";
            })
            ->toJson();
    }

    /**
     * Método responsavel por retornar um unico pedido
     *@return JSON
     */
    public function getDemand($id){
        if($id){
            $demand= Demand::with(['client' ,'status_demand', 'demand_x_product', 'demand_x_product.product'])->find($id);

            return response()->json([
                'success' => true,
                'data' => $demand,
                'view' => view('layouts.demands-modal')->with(['demand' => $demand, 'allows_low' => $demand->status_demand->allows_low])->render(),
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }

    /**
     * Método para confirmar pedido (entregue)
     *@param $id
     *@return json
     */
    public function confirmDemand($id){
        if(is_numeric($id)){
            $demand = Demand::find($id);

            if($demand){
                $demand->status_demand_id = 3;
                $demand->save();
                return response()->json([
                    'success' => true
                ]);
            }
        }

        return response()->json([
            'success' => false
        ]);
    }

    /**
     * Método para cancelar pedido
     *@param $id
     *@return json
     */
    public function cancelDemand($id){
        if(is_numeric($id)){
            $demand = Demand::find($id);

            if($demand){
                $demand->status_demand_id = 5;
                $demand->save();
                return response()->json([
                    'success' => true
                ]);
            }
        }

        return response()->json([
            'success' => false
        ]);
    }

}