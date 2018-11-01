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
        return view('demands');
    }

    /**
     * Método responsavel por retornar os pedidos pro admin
     *@return JSON
     */
    public function getAllDemands(){
        $model = Demand::with(['client' ,'status_demand'])->whereIn('status_demand_id', [1,2])->get();
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
     * Método responsavel por retornar os pedidos cancelados pro admin
     *@return JSON
     */
    public function getCancelDemands(){
        $model = Demand::with(['client' ,'status_demand'])->whereIn('status_demand_id', [4])->get();

        return  DataTables::collection($model)
            ->addColumn('action', function ($model) {
                return "
                <button class='btn btn-primary view_demand' id='" . $model->id . "' style='margin-right:3px;'><span class='glyphicon glyphicon-search'></span></button>";
            })
            ->toJson();
    }

    /**
     * Método responsavel por retornar os pedidos finalizados pro admin
     *@return JSON
     */
    public function getFinalizedDemands(){
        $model = Demand::with(['client' ,'status_demand'])->whereIn('status_demand_id', [3])->get();

        return  DataTables::collection($model)
            ->addColumn('action', function ($model) {
                return "
                <button class='btn btn-primary view_demand' id='" . $model->id . "' style='margin-right:3px;'><span class='glyphicon glyphicon-search'></span></button>";
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
                'view' => view('layouts.demands-modal')->with('demand', $demand)->render(),
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
                $demand->status_demand_id = 4;
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