<?php
/**
 * Class Clients(Auth) - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
     * Método responsavel por realizar Login de usuário
     *@param $request
     *@return JSON
     */
    public function Authenticate(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        if(array_key_exists('authenticate', $request->all())) {
            $data = $request->authenticate;
            $validator = Validator::make($data, $rules, Helper::messages());
            if ($validator->passes()) {
                $credentials = ['email' => $data['email'], 'password' => $data['password']];
                if (! $token = $this->jwtAuth->attempt($credentials)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Ops, those credentials are invalid']);
                }
                return Response()->json([
                    'success' => true,
                    'token' => $token,
                    'message' => 'Authenticate Success']);
            }else{
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()]);
            }
        }
        return Response()->json([
            'success' => false,
            'message' => 'Please determine JSON inside {authenticate}']);
    }

    public function Refresh(){
        $token = $this->jwtAuth->getToken();
        $token = $this->jwtAuth->refresh($token);
        return Response()->json([
            'success' => true,
            'token' => $token,
            'message' => 'Token refreshed with success']);
    }

    public function Logout(){
        $token = $this->jwtAuth->getToken();
        $this->jwtAuth->invalidate($token);
        return response()->json(['logout']);
    }

    public function getDataAuthUser(){
        if (!$data = $this->jwtAuth->parseToken()->authenticate()) {
            return Response()->json([
                'success' => false,
                'message' => 'User not found, try again']);
        }
        return Response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Success to get data']);
    }
}