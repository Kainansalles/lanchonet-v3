<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use Carbon\Carbon;

//models
use App\Models\Client;
use App\Models\PasswordReset;
use App\Helpers\Helper;


class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $rules = [
            'email' => 'required|email'
        ];
        if(array_key_exists('create', $request->all())) {
            $data = $request->create;
            $validator = Validator::make($data, $rules, Helper::messages());
            if ($validator->passes()) {
                $user = Client::where('email', $data['email'])->first();

                if (!$user)
                    return response()->json([
                        'success' => false,
                        'message' => 'Não conseguimos encontrar um usuário com esse endereço de e-mail.'
                    ]);
                $passwordReset = PasswordReset::updateOrCreate(
                    ['email' => $user->email],
                    [
                        'email' => $user->email,
                        'token' => str_random(60)
                    ]
                );
                if ($user && $passwordReset)
                    $user->notify(
                        new PasswordResetRequest($passwordReset->token, $user->name)
                    );
                return response()->json([
                    'success' => true,
                    'message' => 'Enviamos um e-mail com um link de redefinição de senha!'
                ]);
            }
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Por favor envie o JSON em {create}']);
    }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'success' => false,
                'message' => 'Este token de redefinição de senha é inválido.'
            ]);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'success' => false,
                'message' => 'Este token de redefinição de senha é inválido.'
            ]);
        }
        return response()->json([
            'success' => true,
            'token' => $passwordReset]);
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request){
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|confirmed',
            'token' => 'required|string'
        ];
        if(array_key_exists('reset', $request->all())) {
            $data = $request->reset;
            $validator = Validator::make($data, $rules, Helper::messages());
            if ($validator->passes()) {
                $passwordReset = PasswordReset::where([
                    ['token', $data['token']],
                    ['email', $data['email']]
                ])->first();
                if (!$passwordReset)
                    return response()->json([
                        'success' => false,
                        'message' => 'Este token de redefinição de senha é inválido.'
                    ]);
                $user = Client::where('email', $passwordReset->email)->first();
                if (!$user)
                    return response()->json([
                        'success' => false,
                        'message' => 'Não conseguimos encontrar um usuário com esse endereço de e-mail.'
                    ]);
                $user->password = bcrypt($data['password']);
                $user->save();
                $passwordReset->delete();
                $user->notify(new PasswordResetSuccess($passwordReset));
                return response()->json([
                    'success' => true,
                    'data' => $user]);
            }
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Por favor envie o JSON em {reset}']);
    }
}