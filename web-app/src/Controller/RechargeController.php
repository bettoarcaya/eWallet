<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RechargeController extends AbstractController
{
    /**
     * @Route("/recharge", name="recharge")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $document = $this->getUser()->getDocumento();
        $phone = $this->getUser()->getCelular();
        return $this->render('recharge/index.html.twig', [
            'controller_name' => 'RechargeController',
            'document' => $document,
            'phone' => $phone
        ]);
    }
}
