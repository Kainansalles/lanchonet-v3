<?php
/**
 * Class Product - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */
namespace App\Http\Controllers;

use Date;

//Models
use App\Models\Product;
use App\Models\Store;

class ProductsController extends Controller
{
    /**
     * Método responsavel por retornar os produtos
     *@return JSON
     */
    public function getAll(){
        $estabelecimento = Store::find(1);
        $explode = explode(',', $estabelecimento->works_days);
        if (in_array(date("D"), $explode)) {
            $now = strtotime(date('H:i:s'));
            $startdate = strtotime($estabelecimento->open_hours);
            $enddate = strtotime($estabelecimento->close_hours);
            if($now >= $startdate && $now <= $enddate) {
                $produtos = Product::where([
                        ['status', '=', 1],
                        ['quantity', '>=', 1]
                    ])->paginate(8);
                if(!$produtos->isEmpty()){
                    return response()->json($produtos);
                }
                return response()->json([
                    'success' => false,
                    "status" => 0,
                    'message' => 'Sem produtos registrados']);
            }
            return response()->json([
                'success' => false,
                "status" => 3,
                'message' => 'Fora do horário comercial']);
        }
        return response()->json([
            'success' => false,
            "status" => 2,
            'message' => 'Fora dos dias úteis']);
    }

    /**
     * Método responsavel trazer um produtos específico
     *@param $id
     *@return JSON
     */
    public function getProduct($id){
        if(is_numeric($id)){
            if($product = Product::find($id)){
                return response()->json([
                    'success' => true,
                    "data" => $product]);
            }
            return response()->json([
                'success' => false,
                "errors" => 'Produto não encontrado']);
        }
        return response()->json([
            'success' => false,
            "errors" => 'Parâmetro precisa ser numérico']);
    }
}