<?php
// src/MessageHandler/SendOtpMessageHandler.php

namespace App\MessageHandler;

use App\Message\SendOtpMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Psr\Log\LoggerInterface;

#[AsMessageHandler]
class SendOtpMessageHandler
{
  private LoggerInterface $logger;
  private string $sender;

  public function __construct(LoggerInterface $logger)
  {
    $this->logger = $logger;
    $this->sender = $_ENV['OTP_SENDER'] ?? 'MyApp';
  }

  public function __invoke(SendOtpMessage $message): void
  {
    $otp = rand(100000, 999999);
    $logMessage = "Sending OTP $otp to {$message->phoneNumber} from {$this->sender}";
    $this->logger->info($logMessage);

    // Simulate actual send (e.g., via email or internal SMS gateway)
    file_put_contents(__DIR__ . '/../../var/log/otp_log.txt', $logMessage . PHP_EOL, FILE_APPEND);
  }
}
