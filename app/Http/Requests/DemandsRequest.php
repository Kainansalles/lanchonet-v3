<?php
/**
 * Class Demands - Request
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use App\Models\Store;

class DemandsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'make.client_id' => 'required|integer|exists:clients,id',
            'make.store_id' => 'required|integer|exists:stores,id',
            'make.hour_recall' => ['required', 'date_format:Y-m-d H:i', function ($attribute, $value, $fail) {
                $store = Store::find(1);
                $time = substr($store->minutes_min_recall, 3, 2);
                if(strtotime($value) >= strtotime("+ $time minutes") ) {
                   return true;
                }

                $fail(":attribute horário precisa ser maior que $time minutos do horario atual!");
            }],
            'make.products' => 'required',
            'make.products.*' => function ($attribute, $value, $fail) {
                $produto = Product::find($value['product_id']);
                if($produto->quantity >= $value['quantity']){
                    return true;
                }
                $fail(':attribute quantidade indisponivel para este produto!');
            },
            'make.products.*.product_id' => 'required|integer|exists:products,id',
            'make.products.*.quantity' => 'required|integer|min:1',
            'make.products.*.price_registred' => 'required|numeric'
        ];
    }
}
