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
    //return $router->app->version();
    return phpinfo();
});

$router->get('/test-soap', function() use ($router) {

    $wsdl = env('SOAP_SERVER_URL').'index.php/wallet/service?wsdl';

    try {
        $cliente = new SoapClient($wsdl);
        $response = $cliente->call('hello');

        dd($response);
    }catch ( \Exception $e) {
        //Log::info('Caught Exception in client'. $e->getMessage());
        dd($e->getMessage());
    }

});

$router->post('client/register', 'WalletController@registrarCliente');
$router->post('client/recharge', 'WalletController@recargarSaldo');
