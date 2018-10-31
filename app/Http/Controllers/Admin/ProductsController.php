<?php
/**
 * Class AdminProdutos - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use DataTables;

// Models
use App\Models\Product;

use App\Helpers\Helper;

class ProductsController extends Controller
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
        return view('products');
    }

    /**
     * Método responsavel por retornar os produtos pro admin
     *@return JSON
     */
    public function todosProdutosAdmin(){
        $model = Product::query();
        return DataTables::of($model)
        ->addColumn('action', function ($model) {
            return "<button class='btn btn-success editar_botao' id='" . $model->id . "' style='margin-right:3px;'><span class='fa fa-edit'></span></button><button class='btn btn-danger excluir_botao' id='" . $model->id ."' ><span class='fa fa-trash-o'></span></button>";
        })
        ->toJson();
    }

    /**
     * Método para adicionar produto ao DB
     *@param $request
     *@return json
    */
    public function adicionarProduto(Request $request){
        $rules = [
            'name' => 'required|string|max:50',
            'url_image' => 'required|image|mimes:jpeg,png,jpg|max:512',
            'price_sale' => 'required'
        ];

        $messages = [
            'required' => ':attribute campo é obrigatório',
            'mimes' => ':attribute é necessário ser jpeg, jpg ou png',
            "max" => ':attribute permite o máximo de 512kb'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->passes()) {
            $requestData = $request->all();
            if ($request->hasFile('url_image') &&
                $request->file('url_image')->isValid()) {
                    $requestData['url_image'] = Storage::disk('s3')->url(Storage::disk('s3')->putFile('/', $request->file('url_image'), 'public'));
            }
            if(Product::create($requestData)){
                return response()->json(['success' => 'Inserido com sucesso']);
            }else{
                return response()->json(['errors' => 'Falha ao inserir']);
            }
       } else {
           return response()->json(['errors' => $validator->errors()->all()]);
       }
    }

    /**
     * Método para excluir produto
     *@param $id
     *@return json
    */
    public function Excluir($id){
        $produto = Product::find($id);
        if(isset($produto)){
            if($produto->delete()){
                $s3 = Storage::disk('s3');
                if($s3->exists(Helper::getNameImages($produto->url_image))){
                    Storage::disk('s3')->delete(Helper::getNameImages($produto->url_image));
                }else{
                    return response()->json([
                        'success' => 'Deletado com sucesso!',
                        'errors' => 'Imagem inexistente no bucket S3']);
                }
                return response()->json(['success' => 'Deletado com sucesso!']);
            }else{
                return response()->json(['errors' => 'Falha ao deletar']);
            }
        }
    }

    /**
     * Método para editar produto
     *@param $request, $id
     *@return json
    */
    public function Editar(Request $request, $id){
        $rules = [
            'name' => 'required|string|max:50',
            'price_sale' => 'required'
        ];

        $messages = [
            'required' => ':attribute campo é obrigatório'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->passes()) {
            if($id){
                $produto = Product::find($id);
                if(isset($produto)){
                    $requestData = $request->all();
                    if ($request->hasFile('url_image') &&
                        $request->file('url_image')->isValid()) {
                            Storage::disk('s3')->putFileAs('/', $request->file('url_image'), Helper::getNameImages($produto->url_image));
                    }
                    $requestData['url_image'] = $produto->url_image;
                    $produto->fill($requestData);
                    if($produto->save()){
                        return response()->json(['success' => 'Alterado com sucesso!']);
                    }else{
                        return response()->json(['errors' => 'Falha ao salvar']);
                    }
                }
            }
       } else {
           return response()->json(['errors' => $validator->errors()->all()]);
       }
    }

}
