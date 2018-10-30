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

//Models
use App\Models\Demand;
use App\Models\Product;

class DemandsController extends Controller
{
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
}