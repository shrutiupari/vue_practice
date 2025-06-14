<?php

namespace App\Message;

class SendOtpMessage
{
  public function __construct(
    public readonly string $phoneNumber
  ) {}
}
