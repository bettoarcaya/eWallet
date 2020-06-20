<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class WalletController extends Controller
{
    private $wsdl;

    public function __construct()
    {
        $this->wsdl = env('SOAP_SERVER_URL');
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

        try {
            $service = new \SoapClient($this->wsdl);
            $response = $service->registroClientes($data);
        }catch (\Exception $e){
            $response = null;
        }

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

        try {
            $service = new \SoapClient($this->wsdl);
            $response = $service->recargarSaldo($data);
        }catch(\Exception $e) {
            $response = null;
        }

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

        try {
            $service = new \SoapClient($this->wsdl);
            $response = $service->pagar($data);
        }catch(\Exception $e) {
            $response = null;
        }

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

        try {
            $service = new \SoapClient($this->wsdl);
            $response = $service->confirmar($data);
        }catch(\Exception $e) {
            $response = null;
        }

        return response()->json([
            'success' => ($response != null),
            'message' => ($response == 'OK') ? 'Pago confirmado satisfactoriamente' : 'Algo salio mal',
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

        try {
            $service = new \SoapClient($this->wsdl);
            $response = $service->consultarSaldo($data);
        }catch(\Exception $e) {
            $response = null;
        }

        return response()->json([
            'success' => ($response != null),
            'message' => '',
            'data' => $response
        ]);
    }

    public function listarClientes()
    {
        try {
            $service = new \SoapClient($this->wsdl);
            $response = $service->listarClientes();
        }catch(\Exception $e) {
            $response = null;
        }

        return response()->json([
            'success' => ($response != null),
            'message' => '',
            'data' => $response
        ]);
    }

    public function listarPagos()
    {
        try {
            $service = new \SoapClient($this->wsdl);
            $response = $service->listarPagos();
        }catch(\Exception $e) {
            $response = null;
        }

        return response()->json([
            'success' => ($response != null),
            'message' => '',
            'data' => $response
        ]);
    }

}
