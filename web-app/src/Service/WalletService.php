<?php


namespace App\Service;


use App\Entity\Client;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class WalletService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entity_manager)
    {
        $this->entityManager = $entity_manager;
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
        $client->setUserId($this->getUser()->id);

        $this->entityManager->persist($client);
        $this->entityManager->flush();

        return $client;
    }

    public function recargarSaldo($values)
    {
        
    }
}