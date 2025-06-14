<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\SendOtpMessage;


class OtpController extends AbstractController
{
  #[Route('/api/send-otp', name: 'send_otp', methods: ['POST'])]
  public function sendOtp(Request $request, MessageBusInterface $bus): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    if (!isset($data['phoneNumber'])) {
      return new JsonResponse(['message' => 'Missing parameters'], 400);
    }

    $bus->dispatch(new SendOtpMessage($data['phoneNumber']));

    return new JsonResponse(['message' => 'Receipt processing started']);
  }
}
