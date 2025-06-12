<?php
// src/Controller/ReceiptController.php

namespace App\Controller;

use App\Message\SendReceiptMessage as MessageSendReceiptMessage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

class ReceiptController extends AbstractController
{
  #[Route('/api/send-receipt', name: 'send_receipt', methods: ['POST'])]
  public function sendReceipt(Request $request, MessageBusInterface $bus): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    if (!isset($data['email'], $data['amount'])) {
      return new JsonResponse(['message' => 'Missing parameters'], 400);
    }

    $bus->dispatch(new MessageSendReceiptMessage($data['email'], $data['amount']));

    return new JsonResponse(['message' => 'Receipt processing started']);
  }

  #[Route('/api/receipts', name: 'get_receipts', methods: ['GET'])]
  public function getReceipts(): JsonResponse
  {
    $data = [
      "email" => "john.example.com",
      "amount" => 123.45,
      "date" => (new \DateTime())->modify('-1 hour')->format((DATE_ATOM)),
      "email" => "john.example.com",
      "amount" => 100,
      "date" => (new \DateTime())->modify('-1 hour')->format((DATE_ATOM))
    ];

    return new JsonResponse(($data));
  }
}
