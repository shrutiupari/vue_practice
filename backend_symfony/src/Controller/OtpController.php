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

    return new JsonResponse(['message' => 'OTP sent successfully']);
  }
}
// class OtpController extends AbstractController
// {
//   #[Route('/api/send-otp', name: 'send_otp', methods: ['POST'])]
//   public function sendOtp(Request $request): JsonResponse
//   {
//     $data = json_decode($request->getContent(), true);
//     $otp = rand(100000, 999999);
//     file_put_contents(__DIR__ . '/../../var/log/otp.log', $data['phoneNumber'] . ': ' . $otp . PHP_EOL, FILE_APPEND);
//     return $this->json(['success' => true]);
//   }
// }

// namespace App\Controller;

// use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// class OtpController extends AbstractController
// {
//   #[Route('/api/send-otp', name: 'send_otp', methods: ['POST'])]
//   public function sendOtp(Request $request): JsonResponse
//   {
//     $data = json_decode($request->getContent(), true);
//     print_r($data);
//     echo "\n\n";
//     $otp = rand(100000, 999999);
//     file_put_contents(__DIR__ . '/../../var/log/otp.log', $data['phoneNumber'] . ': ' . $otp . PHP_EOL, FILE_APPEND);
//     return $this->json(['success' => true]);
//   }
// }
