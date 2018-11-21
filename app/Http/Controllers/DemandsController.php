<?php
/**
 * Class Demands - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */
namespace App\Http\Controllers;

use DB;
use App\Http\Requests\DemandsRequest;
use Tymon\JWTAuth\JWTAuth;

//Models
use App\Models\Demand;
use App\Models\Product;

class DemandsController extends Controller
{

    /**
     * @var JWTAuth
     */
    private $jwtAuth;

    public function __construct(JWTAuth $jwtAuth){
        \Config::set('jwt.user' , "App\Models\Client");
        \Config::set('auth.providers.users.model', \App\Models\Client::class);
        $this->jwtAuth = $jwtAuth;
    }
    /**
     * Método para realizar um pedido
     *@param $request
     *@return JSON
     */
    public function doDemand(DemandsRequest $request){
        $data = $request->only('make')['make'];
        DB::beginTransaction();
        try {
            $pedido = Demand::create($data);
            $pedido->demand_x_product()->createMany($data['products']);
            foreach ($data['products'] as $item) {
                $product = Product::find($item['product_id']);
                $product->decrement('quantity', $item['quantity']);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Pedido realizado com sucesso!']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()]);
        }
    }

    /**
     * Método para realizar pegar um pedido especifíco
     *@param $request
     *@return JSON
     */
    public function getDemand($id){
        $demand = Demand::with(['client' ,'status_demand', 'demand_x_product', 'demand_x_product.product'])->find($id);

        if($demand){
            return response()->json([
                'success' => true,
                'data' => $demand,
                'message' => "Sucesso ao encontrar dados do pedido"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Falha ao encontrar dados do pedido"
        ]);
    }

     /**
     * Método para realizar pegar todos os pedidos do cliente autenticado
     *@param $request
     *@return JSON
     */
    public function getAllDemands(){
        $user = $this->jwtAuth->parseToken()->authenticate();
        $demands = Demand::with(['client' ,'status_demand', 'demand_x_product', 'demand_x_product.product'])->where('client_id', [$user->id])->paginate(5);
        if($demands){
            return response()->json([
                'success' => true,
                'data' => $demands,
                'message' => "Sucesso ao encontrar dados dos pedidos"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Falha ao encontrar dados dos pedidos"
        ]);
    }

}