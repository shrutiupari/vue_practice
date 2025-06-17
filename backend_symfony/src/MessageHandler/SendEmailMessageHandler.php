<?php

namespace App\MessageHandler;

use App\Message\SendEmailMessage;
use App\Repository\InvoiceRepository;
use App\Service\EmailQueueService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler] // ✅ Auto-register this as a Messenger handler
class SendEmailMessageHandler
{
  public function __construct(
    private InvoiceRepository $repo,
    private EmailQueueService $emailService
  ) {}

  public function __invoke(SendEmailMessage $message): void
  {
    $invoice = $this->repo->find($message->getInvoiceId());

    if (!$invoice) {
      // Optional: log, throw, or skip silently
      return;
    }

    $this->emailService->sendInvoice($invoice);
  }
}
