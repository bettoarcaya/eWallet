<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class WalletController extends Controller
{
    private $wsdl;

    public function __construct()
    {
        $this->wsdl = env('SOAP_SERVER_URL').'index.php/wallet/service?wsdl';
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
            'success' => ($response == 'OK'),
            'message' => ($response == 'OK') ? 'Cliente satisfactoriamente' : 'Algo salio mal',
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
            'success' => ($response == 'OK'),
            'message' => ($response == 'OK') ? 'Saldo recargado satisfactoriamente' : 'Algo salio mal',
            'data' => $response
        ]);
    }

    public function pagar(Request $request)
    {
        $this->validate($request, [
            'documento' => 'required',
            'monto' => 'required'
        ]);

        $data = $request->all();

        $service = new \SoapClient($this->wsdl);
        $response = $service->pagar($data);

        return response()->json([
            'success' => ($response == 'OK'),
            'message' => ($response == 'OK') ? 'Por favor ingrese el token de confirmacion' : 'Algo salio mal',
            'data' => $response
        ]);
    }

    public function confirmarPago( Request $request )
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $data = $request->all();

        $service = new \SoapClient($this->wsdl);
        $response = $service->confirmar($data);

        return response()->json([
            'success' => true,
            'data' => $response
        ]);
    }

    public function consultarSaldo(Request $request)
    {
        $this->validate($request, [
            'documento' => 'required',
            'celular' => 'required'
        ]);

        $data = $request->all();

        $service = new \SoapClient($this->wsdl);
        $response = $service->consultarSaldo($data);

        return response()->json([
            'success' => ($response != null),
            'message' => '',
            'data' => $response
        ]);
    }

}
