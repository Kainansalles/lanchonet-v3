<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('clients/new', 'ClientsController@setNewUser');//->middleware(['cors']);
Route::post('clients/recoverpw', 'ClientsController@recoverPW');
Route::group([
    'prefix' => 'clients',
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/edituser', 'ClientsController@editUser');
    Route::post('/editpw', 'ClientsController@editPW');
});

Route::get('clients/auth/dataclient', 'Auth\ClientsController@getDataAuthUser')->middleware('jwt.auth');
Route::group([
    'namespace' => 'Auth',
    'prefix' => 'clients/auth'
], function () {
    Route::post('/authenticate', 'ClientsController@Authenticate');
    Route::post('/refresh', 'ClientsController@Refresh');
    Route::post('/logout', 'ClientsController@Logout');
});

Route::group([
    //'middleware' => 'api',
    'prefix' => 'password/reset'
], function () {
    Route::post('/create', 'PasswordResetController@create');
    Route::get('/redirectapp/{token}', 'PasswordResetController@redirectToApp');
    Route::get('/find/{token}', 'PasswordResetController@find');
    Route::post('/reset', 'PasswordResetController@reset');
});

Route::group([
    //'middleware' => 'cors',
    'prefix' => 'products'
], function () {
    Route::get('/all', 'ProductsController@getAll');
    Route::get('/{id}', 'ProductsController@getProduct');
});

Route::group([
    'prefix' => 'demand',
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/make', 'DemandsController@doDemand');
});