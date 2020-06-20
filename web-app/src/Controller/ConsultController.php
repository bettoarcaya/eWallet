<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConsultController extends AbstractController
{
    /**
     * @Route("/consult", name="consult")
     */
    public function index()
    {
        $document = $this->getUser()->getDocumento();
        $phone = $this->getUser()->getCelular();

        return $this->render('consult/index.html.twig', [
            'controller_name' => 'ConsultController',
            'document' => $document,
            'phone' => $phone
        ]);
    }
}
