<?php
/**
 * Class Clientes - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Tymon\JWTAuth\JWTAuth;

// Models
use App\Models\Client;
use App\Helpers\Helper;

class ClientsController extends Controller{

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
     * Método responsavel por realizar a criação de um novo usuáro
     *@param $request
     *@return Boolean
     */
    public function setNewUser(Request $request){

        $requiredfields = array("name", "cpf", "email", "password");
        $rules = [
            'integer' => [
                ['cpf']
            ],
            'length' => [
                ['cpf', 11]
            ],
            'email' => [
                ['email']
            ],
            'lengthMax' => [
                ['name', 50]
            ]
        ];

        $dataRequest = $request->json()->all();
        if(array_key_exists('new', $dataRequest)){
            $data = $dataRequest['new'];
            if(Helper::ValidaRequest($data, $requiredfields, $rules)){
                if($this->validateUser($data, 'New')){
                    $data['password'] = Hash::make($data['password']);
                    if(Client::create($data)){
                        return response()->json([
                            'success' => true,
                            'message' => 'Usuário criado com sucesso']);
                    }
                }
                return response()->json([
                    'success' => false,
                    'message' => 'Possuímos um usuário com esse e-mail ou CPF']);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Por favor determine o JSON dentro de {new}']);
    }

    /**
     * Método responsavel por realizar a edição dos dados do usuário
     *@param $request
     *@return JSON
     */
    public function editUser(Request $request){
        $rules = [
            'nickname' => 'string',
            'telephone' => 'numeric',
            'dt_birth' => 'date',
            'name' => 'string',
        ];

        if(array_key_exists('edituser', $request->all())) {
            $data = $request->edituser;
            $validator = Validator::make($data, $rules, Helper::messages());
            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    $user = $this->jwtAuth->parseToken()->authenticate();
                    $cliente = Client::find($user->id);
                    if(isset($cliente)){
                        $cliente->fill($data);
                        $cliente->save();
                    }
                    DB::commit();
                    return response()->json([
                        'success' => true,
                        'message' => 'Sucesso ao editar dados do usuário']);

                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'success' => false,
                        'errors' => $e->getMessage()]);
                }
            }
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Por favor determine o JSON dentro de {edituser}']);
    }

    /**
     * Método responsavel por realizar a alteração de password do usuário
     *@param $request
     *@return JSON
     */
    public function editPW(Request $request){
        $rules = [
            'old_password' => 'required',
            'password' => 'required',
        ];

        if(array_key_exists('editpw', $request->all())) {
            $data = $request->editpw;
            $validator = Validator::make($data, $rules, Helper::messages());
            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    $user = $this->jwtAuth->parseToken()->authenticate();
                    $cliente = Client::find($user->id);
                    if(isset($cliente)){
                        if(Hash::check($data['old_password'], $cliente->password)) {
                            unset($data['old_password']);
                            $data['password'] = Hash::make($data['password']);
                            $cliente->fill($data);
                            $cliente->save();
                        }else{
                            return response()->json([
                                'success' => false,
                                'message' => 'Senha antiga incorreta']);
                        }
                        DB::commit();
                        return response()->json([
                            'success' => true,
                            'message' => 'Sucesso ao editar']);
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'success' => false,
                        'errors' => $e->getMessage()]);
                }
            }
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Por favor determine o JSON dentro de {editpw}']);
    }

    /**
     * Validação de registros no DB
     *@param $dataRequest, $type
     *@return object
     */
    private function validateUser($dataRequest, $type){
        switch ($type) {
            case 'New':
                $verify = Client::where('cpf', '=', $dataRequest['cpf'])
                    ->orWhere('email', '=', $dataRequest['email'])
                    ->exists();
                if(!$verify){
                    return true;
                }
                break;

            case 'UserExists':
                $usuario = Client::where([
                    ['email', '=', $dataRequest['email'] ]
                ])->first();
                if($usuario)
                    return $usuario;
                break;
        }
    }
}