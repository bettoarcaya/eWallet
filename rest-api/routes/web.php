<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Log;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('client/register', 'WalletController@registrarCliente');
$router->post('client/recharge', 'WalletController@recargarSaldo');
$router->post('client/pay', 'WalletController@pagar');
$router->post('client/confirm-payment', 'WalletController@confirmarPago');
$router->post('client/get-balance', 'WalletController@consultarSaldo');

$router->get('client/', 'WalletController@listarClientes');
$router->get('client/get-payments', 'WalletController@listarPagos');
