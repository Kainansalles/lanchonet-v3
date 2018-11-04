<?php
/**
 * Class AdminConfiguracoes - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

// Models
use App\Models\Store;

class ConfigController extends Controller
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
        return view('config')->with(['estabelecimento' => Store::find(1)]);
    }

    /**
     * Método de atualizar configurações do administrador
     *
     * @return boolean
     */
    public function Editar(Request $request){
        $rules = [
            'cnpj' => 'required',
            'nickname' => 'required|string|max:50',
            'company_name' => 'required|string|max:50',
            'bank_account' => 'required',
            'bank_agency' => 'required',
            'open_hours' => 'required',
            'close_hours' => 'required',
            'works_days' => 'required',
        ];

        $messages = [
            'required' => ':attribute campo é obrigatório'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->passes()) {
            $estabelecimento = Store::find($request['id']);
            if(isset($estabelecimento)){
                $estabelecimento->fill($request->all());
                if($estabelecimento->save()){
                    return response()->json([
                        'success' => true,
                        'message' => 'Sucesso ao atualizar']);
                }
                return response()->json([
                    'success' => false,
                    'errors' => 'Falha ao atualizar']);
            }
       }
       return response()->json([
        'success' => false,
        'errors' => $validator->errors()->all()]);
    }
}