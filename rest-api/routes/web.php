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

$router->get('/', function () use ($router) {
    //return $router->app->version();
    return phpinfo();
});

$router->get('/test-soap', function() use ($router) {
    $wsdl = 'http://ewallet.test:40/index.php/wallet/service?wsdl';

    $cliente = new \SoapClient($wsdl);
    $response = $cliente->hello();

    dd($response);
});

$router->post('client/register', 'WalletController@registrarCliente');
$router->post('client/recharge', 'WalletController@recargarSaldo');
