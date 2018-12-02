<?php
/**
 * Class Dashboard - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */
namespace App\Http\Controllers;

//Models
use App\Models\DemandxProduct;

class DashboardController extends Controller
{

    /**
     * Método responsável por retornar JSON de top 3 de (Produtos)
     *
     */
    public function dataProducts(){
        $data = DemandxProduct::select(\DB::raw('products.name as title, count(*) as value, products.url_image, products.description, products.price_sale'))
            ->join('products', 'demand_x_products.product_id', '=', 'products.id')
            ->groupBy(['products.name', 'products.url_image', 'products.description', 'products.price_sale'])
            ->orderBy('value', 'DESC')
            ->limit(3)
            ->get();
        return response()->json($data);
    }
}