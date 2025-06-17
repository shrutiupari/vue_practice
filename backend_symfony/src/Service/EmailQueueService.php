<?php

namespace App\Service;

use App\Entity\Invoice;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class EmailQueueService
{
  private MailerInterface $mailer;
  private string $fromEmail;
  private string $fromName;

  public function __construct(MailerInterface $mailer, string $fromEmail = 'billing@yourclinic.com', string $fromName = 'Clinic Billing')
  {
    $this->mailer = $mailer;
    $this->fromEmail = $fromEmail;
    $this->fromName = $fromName;
  }

  public function sendInvoice(Invoice $invoice): void
  {
    $email = (new TemplatedEmail())
      ->from(new Address($this->fromEmail, $this->fromName))
      ->to($invoice->getPatientEmail())
      ->subject('Your Invoice from ' . $this->fromName)
      ->htmlTemplate('emails/invoice_email.html.twig')
      ->context([
        'patient_name' => $invoice->getPatientName(), // Assuming getPatientName() exists
        'invoice' => [
          'description' => $invoice->getDescription(),
          'amount' => $invoice->getAmount(),
        ],
        'organization_name' => $this->fromName,
      ]);

    $this->mailer->send($email);
  }
}
