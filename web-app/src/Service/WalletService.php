<?php


namespace App\Service;


use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class WalletService
{

    public function __construct()
    {

    }

    public function hello()
    {
        return "Hello!";
    }

    public function registroClientes($values)
    {
        $client = new Client();
        $client->setDocumento($values['documento']);
        $client->setNombre($values['nombres']);
        $client->setEmail($values['email']);
        $client->setCelular($values['celular']);

        /*$entityManager->persist($client);
        $entityManager->flush();*/

        return $values;
    }

    public function recargarSaldo($values)
    {

    }
}