<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('download/app', function(){
    //PDF file is stored under project/public/download/lanchonet-app.apk
    $file= public_path(). "/download/lanchonet-app.apk";
     $headers = [
        'Content-Type'=>'application/vnd.android.package-archive',
        'Content-Disposition'=> 'attachment; filename="android.apk"',
    ];
     return Response::download($file, 'lanchonet-app.apk', $headers);
});

Auth::routes();

Route::group([
    'namespace' => 'Admin'
], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/dataclients', 'DashboardController@dataClients');
    Route::get('/datademands', 'DashboardController@dataDemands');
});

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin/pedidos/'
], function () {
    Route::get('/', 'DemandsController@index');
    Route::get('all', 'DemandsController@getAllDemands');
    Route::get('consultdemand/{id}', 'DemandsController@consultDemands');
    Route::get('cancel/{id}', 'DemandsController@cancelDemand');
    Route::get('confirm/{id}', 'DemandsController@confirmDemand');
    Route::get('prepear/{id}', 'DemandsController@preparingDemand');
    Route::get('withdrawal/{id}', 'DemandsController@withdrawalDemand');
    Route::get('/paid/{id}', 'DemandsController@paidDemand');
    Route::get('/getlist/{id}', 'DemandsController@getListDemands');
    Route::get('/{id}', 'DemandsController@getDemand');
});

Route::get('/produtos/todosprodutosadmin', 'ProductsController@todosProdutosAdmin');

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin/produtos/'
],function () {
    Route::get('/', 'ProductsController@index');
    Route::get('todosprodutosadmin', 'ProductsController@todosProdutosAdmin');
    Route::post('editar/{id}', 'ProductsController@Editar');
    Route::delete('excluir/{id}', 'ProductsController@Excluir');
    Route::post('novo', 'ProductsController@adicionarProduto');
});

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin/usuarios/'
],function () {
    Route::get('/', 'UsersController@index');
    Route::get('all', 'UsersController@getAllUsers');
    Route::post('new', 'UsersController@newUser');
    Route::delete('delete/{id}', 'UsersController@Destroy');
});

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin/configuracoes/'
],function () {
    Route::get('/', 'ConfigController@index');
    Route::put('editar/{id}', 'ConfigController@Editar');
});

//use PhpAmqpLib\Message\AMQPMessage;
//use PhpAmqpLib\Connection\AMQPConnection;
//
//Route::group([
//    'prefix' => 'teste/'
//],function () {
//
//    $connection = new AMQPConnection(
//        env('RABBITMQ_HOST'),
//        env('RABBITMQ_PORT'),
//        env('RABBITMQ_LOGIN'),
//        env('RABBITMQ_PASSWORD'),
//        env('RABBITMQ_VHOST')
//    );
//    $channel = $connection->channel();
//    $exchange = 'lanchonet';
//
//    $channel->exchange_declare($exchange, 'direct', false, false, false);
//    $channel->queue_declare(
//        'demands',    #queue - Queue names may be up to 255 bytes of UTF-8 characters
//        false,              #passive - can use this to check whether an exchange exists without modifying the server state
//        false,               #durable, make sure that RabbitMQ will never lose our queue if a crash occurs - the queue will survive a broker restart
//        false,              #exclusive - used by only one connection and the queue will be deleted when that connection closes
//        false               #auto delete - queue is deleted when last consumer unsubscribes
//    );
//
//    $channel->queue_bind('demands', $exchange);
//    $msg = new AMQPMessage(
//        json_encode(array('nome' => 'amizade')),
//        array('delivery_mode' => 2) # make message persistent, so it is not lost if server crashes or quits
//    );
//
//    $channel->basic_publish(
//        $msg,               #message
//        '',                 #exchange
//        'demands'     #routing key (queue)
//    );
//
//    $channel->close();
//    $connection->close();
//});
