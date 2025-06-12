<?php

namespace App\MessageHandler;

use App\Message\SendReceiptMessage;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendReceiptMessageHandler
{
  public function __construct(private MailerInterface $mailer) {}
  public function __invoke(SendReceiptMessage $message): void
  {
    $email = (new Email())
      ->from('shrutiupari@gmail.com')
      ->to($message->email)
      ->subject("Your Payment Receipt")
      ->text("Thank you for your payment of $ " . $message->amount . ". Receipt attached. ");

    $this->mailer->send($email);
  }
}
