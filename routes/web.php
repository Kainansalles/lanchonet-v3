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
Auth::routes();

Route::group([
    'namespace' => 'Admin'
], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/dataclients', 'DashboardController@dataClients');
    Route::get('/datademands', 'DashboardController@dataDemands');
    Route::get('/dataproducts', 'DashboardController@dataProducts');
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
    'prefix' => 'admin/configuracoes/'
],function () {
    Route::get('/', 'ConfigController@index');
    Route::put('editar/{id}', 'ConfigController@Editar');
});
