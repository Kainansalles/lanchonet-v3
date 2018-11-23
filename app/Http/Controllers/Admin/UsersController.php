<?php
/**
 * Class Users - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\UsersRequest;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\Hash;

// Models
use App\User;

class UsersController extends Controller
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
    public function index(){
        return view('users');
    }

    /**Hash::make(123456)
     * Método responsavel por retornar os pedidos pro admin
     *@return JSON
     */
    public function getAllUsers(){

        $model = User::whereNotIn('id', [\Auth::user()->id])->get();
        return DataTables::collection($model)
            ->addColumn('action', function ($model) {
                return "<button class='btn btn-danger excluir_botao' id='" . $model->id ."' ><span class='fa fa-trash-o'></span></button>";
            })
            ->toJson();
    }

    /**
     * Método responsavel Salvar um novo usuário
     *@return JSON
     */
    public function newUser(UsersRequest $request){
        try {
            $requestData = $request->all();
            $data = [
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                'password' => Hash::make($requestData['password']),
            ];
            if(User::create($data))
                return response()->json(['success' => 'Usuário inserido com sucesso!']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'errors' => $e->getMessage()]);
        }

    }

    /**
     * Método para excluir usuário
     *@param $id
     *@return json
    */
    public function Destroy($id){    
        try {
            $user = User::find($id);
            if($user->delete())
                return response()->json(['success' => 'Deletado com sucesso!']);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()]);
        }

        return response()->json(['errors' => 'Falha ao deletar']);
    }

}