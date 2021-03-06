<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $name = $this->getUser()->getFullname();

        return $this->render('home/index.html.twig', [
            'name' => $name,
        ]);
    }
}
