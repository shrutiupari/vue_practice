<?php

namespace App\Message;

class SendReceiptMessage
{
  public function __construct(
    public readonly string $email,
    public readonly float $amount
  ) {}
}
