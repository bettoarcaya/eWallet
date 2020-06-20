<?php


namespace App\Service;


use App\Entity\Client;
use App\Entity\Payment;
use App\Entity\User;
use App\Entity\Wallet;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class WalletService
{
    private $entityManager;
    private $mailer;
    private $encoders;
    private $normalizers;
    private $serializer;

    public function __construct(
        EntityManagerInterface $entity_manager,
        \Swift_Mailer $mailer
    ){
        $this->entityManager = $entity_manager;
        $this->mailer = $mailer;
        $this->encoders = array(new XmlEncoder(), new JsonEncoder());
        $this->normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
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
        $client->setUserId($this->getUser()->getId());

        $this->entityManager->persist($client);
        $this->entityManager->flush();

        return "Ok";
    }

    public function recargarSaldo($values)
    {
        $client = $this->entityManager->getRepository(User::class)->find($this->getUser()->getId());

        if( $client->getDocumento() != $values['documento'] || $client->getCelular() != $values['celular'] ){
            return null;
        }

        $repository = $this->entityManager->getRepository(Wallet::class);
        $wallet = $repository->findOneBy(['user_id' => $this->getUser()->getId()]);
        $wallet->setBalance($values['valor']);

        $this->entityManager->persist($wallet);
        $this->entityManager->flush();

        return "OK";
    }

    public function pagar($values)
    {
        $repository = $this->entityManager->getRepository(Client::class);
        $client = $repository->findOneBy([
            'user_id' => $this->getUser()->getId(),
            'documento' => $values['documento']
        ]);

        if( $client == null ){
            return null;
        }

        $token = random_bytes ( 6 );

        $payment = new Payment();
        $payment->setUserId($this->getUser()->getId());
        $payment->setClientId($client->getId());
        $payment->setValue($values['monto']);
        $payment->setStatus("pending");
        $payment->setToken($token);

        $this->entityManager->persist($payment);
        $this->entityManager->flush();

        $message = new \Swift_Message('eWallet Service');
        $message->setTo($this->getUser()->getEmail())->setBody('Token: ' . $token);

        $this->mailer->send($message);

        return "OK";
    }

    public function confirmar($values)
    {
        $repository = $this->entityManager->getRepository(Payment::class);
        $payment = $repository->findOneBy([
            'user_id' => $this->getUser()->getId(),
            'token' => $values['token']
        ]);

        $wallet_repository = $this->entityManager->getRepository(Wallet::class);
        $wallet = $wallet_repository->findOneBy([
            'user_id', $this->getUser()->getId()
        ]);

        if( $payment == null || $wallet->getBalance() < $payment->getValue()){
            return null;
        }

        $payment->setStatus('done');
        $this->entityManager->persist($payment);
        $this->entityManager->flush();

        $wallet->setBalance( $wallet->getBalance() - $payment->getValue() );
        $this->entityManager->persist($wallet);
        $this->entityManager->flush();

        return "OK";
    }

    public function consultarSaldo($values)
    {
        $user_repository = $this->entityManager->getRepository(User::class);
        $client = $user_repository->find($this->getUser()->getId());

        if( $client->getDocumento() != $values['documento'] || $client->getCelular() != $values['celular'] ){
            return null;
        }

        $repository = $this->entityManager->getRepository(Wallet::class);
        $wallet = $repository->findOneBy(['user_id' => $this->getUser()->getId()]);

        return $this->serializer->serialize($wallet, 'json');
    }

    public function listarClientes()
    {
        $repository = $this->entityManager->getRepository(Client::class);
        $clients = $repository->findBy([
            'user_id' => $this->getUser()->getId()
        ]);

        return $this->serializer->serialize($clients, 'json');
    }

    public function listarPagos()
    {
        $repository = $this->entityManager->getRepository(Payment::class);
        $payments = $repository->findBy([
            'user_id' => $this->getUser()->getId()
        ]);

        return $this->serializer->serialize($payments, 'json');
    }
}