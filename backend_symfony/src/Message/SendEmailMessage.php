<?php

namespace App\Message;

class SendEmailMessage
{
  public function __construct(private int $invoiceId) {}

  public function getInvoiceId(): int
  {
    return $this->invoiceId;
  }
}
