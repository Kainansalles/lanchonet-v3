<?php
/**
 * Class Admin - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use DataTables;

// Models
use App\Models\User;

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

    /**
     * Método responsavel por retornar os pedidos pro admin
     *@return JSON
     */
    public function getAllUsers(){
        $model = User::all();
        return DataTables::collection($model)
            ->addColumn('action', function ($model) {
                return "<button class='btn btn-success editar_botao' id='" . $model->id . "' style='margin-right:3px;'><span class='fa fa-edit'></span></button>
                    <button class='btn btn-danger excluir_botao' id='" . $model->id ."' ><span class='fa fa-trash-o'></span></button>";
            })
            ->toJson();
    }
}