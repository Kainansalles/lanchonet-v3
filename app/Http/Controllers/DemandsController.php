<?php
/**
 * Class Demands - Controller
 *
 * @author Kainan Salles <kainansalles@gmail.com.br>
 * @link http://www.kaftecnologia.com.br
 */
namespace App\Http\Controllers;

use DB;
use App\Http\Requests\DemandsRequest;
use Tymon\JWTAuth\JWTAuth;

//Models
use App\Models\Demand;
use App\Models\Product;

//RabbitMQ
use \App\Services\RabbitMQService;
use PhpAmqpLib\Message\AMQPMessage;

class DemandsController extends Controller
{
    /**
     * @var JWTAuth
     */
    private $jwtAuth;

    private $rabbitMQService;

    public function __construct(JWTAuth $jwtAuth, RabbitMQService $rabbitMQService){
        \Config::set('jwt.user' , "App\Models\Client");
        \Config::set('auth.providers.users.model', \App\Models\Client::class);
        $this->jwtAuth = $jwtAuth;
        $this->rabbitMQService = $rabbitMQService;
    }
    /**
     * Método para realizar um pedido
     *@param $request
     *@return JSON
     */
    public function doDemand(DemandsRequest $request){

        try{
            $this->rabbitMQService->connectionRabbit();
            $queue = 'demands';
            $this->rabbitMQService->queueDeclare($queue, false, true, false, false );
            $this->rabbitMQService->channel->queue_bind($queue, 'lanchonet');

            $msg = new AMQPMessage(
                json_encode($request->only('make')),
                array('delivery_mode' => 2) # make message persistent, so it is not lost if server crashes or quits
            );

            $this->rabbitMQService->channel->basic_publish(
                $msg,               #message
                '',                 #exchange
                $queue     #routing key (queue)
            );

            $this->rabbitMQService->closeRabbit();

            return response()->json([
                'success' => true,
                'message' => 'Pedido realizado com sucesso, em alguns minutos aparecerá em sua listagem']);


        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()]);
        }


//        $data = $request->only('make')['make'];
//        DB::beginTransaction();
//        try {
//            $pedido = Demand::create($data);
//            $pedido->demand_x_product()->createMany($data['products']);
//            foreach ($data['products'] as $item) {
//                $product = Product::find($item['product_id']);
//                $product->decrement('quantity', $item['quantity']);
//            }
//
//            DB::commit();
//            return response()->json([
//                'success' => true,
//                'message' => 'Pedido realizado com sucesso!']);
//
//        } catch (\Exception $e) {
//            DB::rollback();
//            return response()->json([
//                'success' => false,
//                'errors' => $e->getMessage()]);
//        }
    }

    public function consumerRabbit(){
        $this->rabbitMQService->connectionRabbit();
        $exchange = 'lanchonet';
        $queue = 'demands';
        $callback = function ($msg) {
            DB::beginTransaction();
            try {
                $data = json_decode($msg->body, true)['make'];
                $pedido = Demand::create($data);
                $pedido->demand_x_product()->createMany($data['products']);

                foreach ($data['products'] as $item) {
                    $product = Product::find($item['product_id']);
                    $product->decrement('quantity', $item['quantity']);
                }

                DB::commit();
                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
//
            } catch (\Exception $e) {
                DB::rollback();
            }
        };

        $this->rabbitMQService->channel->queue_bind($queue, $exchange);
        $this->rabbitMQService->channel->basic_qos(null, 1, null);
        $this->rabbitMQService->channel->basic_consume($queue, '', false, false, false, false, $callback);

        while (count($this->rabbitMQService->channel->callbacks)) {
//        while ($this->rabbitMQService->channel->is_consuming()) {
            $this->rabbitMQService->channel->wait();
        }

        $this->rabbitMQService->closeRabbit();

    }

    /**
     * Método para realizar pegar um pedido especifíco
     *@param $request
     *@return JSON
     */
    public function getDemand($id){
        $demand = Demand::with(['client' ,'status_demand', 'demand_x_product', 'demand_x_product.product'])->find($id);

        if($demand){
            return response()->json([
                'success' => true,
                'data' => $demand,
                'message' => "Sucesso ao encontrar dados do pedido"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Falha ao encontrar dados do pedido"
        ]);
    }

     /**
     * Método para realizar pegar todos os pedidos do cliente autenticado
     *@param $request
     *@return JSON
     */
    public function getAllDemands(){
        $user = $this->jwtAuth->parseToken()->authenticate();
        $demands = Demand::with(['client' ,'status_demand', 'demand_x_product', 'demand_x_product.product'])->where('client_id', [$user->id])->paginate(10);
        if($demands){
            return response()->json([
                'success' => true,
                'data' => $demands,
                'message' => "Sucesso ao encontrar dados dos pedidos"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Falha ao encontrar dados dos pedidos"
        ]);
    }

}