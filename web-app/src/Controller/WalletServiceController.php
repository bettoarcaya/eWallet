<?php

namespace App\Controller;

use App\Service\WalletService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WalletServiceController extends AbstractController
{
    /**
     * @Route("/wallet/service", name="wallet_service")
     */
    public function index(WalletService $walletService)
    {
        $soapServer = new \SoapServer('/src/Soap/hellowsdl.wsdl');
        $soapServer->setObject($walletService);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $response->setContent(ob_get_clean());

        return $response;

        /*return $this->render('wallet_service/index.html.twig', [
            'controller_name' => 'WalletServiceController',
        ]);*/
    }

}
