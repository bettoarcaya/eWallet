<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class WalletController extends Controller
{
    private $wsdl;

    public function __construct()
    {
        $this->wsdl = 'http://ewallet.test:40/index.php/wallet/service?wsdl';
    }

    public function registrarCliente( Request $request )
    {
        $this->validate($request, [
            'documento' => 'required',
            'nombres' => 'required',
            'email' => 'required',
            'celular' => 'required'
        ]);

        $data = $request->all();

        $service = new \SoapClient($this->wsdl);
        $response = $service->registroClientes($data);

        return response()->json([
            'data' => $response
        ]);
    }

    public function recargarSaldo( Request $request )
    {
        $this->validate($request, [
            'documento' => 'required',
            'celular' => 'required',
            'valor' => 'required|min:1'
        ]);

        $data = $request->all();

        $service = new \SoapClient($this->wsdl);
        $response = $service->recargarSaldo($data);

        return response()->json([
            'data' => $response
        ]);
    }

}
