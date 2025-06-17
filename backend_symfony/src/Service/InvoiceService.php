<?php

namespace App\Service;

use App\Entity\Invoice;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceService
{
  private $entityManager;

  public function __construct(EntityManagerInterface $em)
  {
    $this->entityManager = $em;
  }

  public function create(array $data): Invoice
  {
    if (!isset($data['amount'], $data['patientId'])) {
      throw new \InvalidArgumentException('Amount and Patient ID are required.');
    }

    $invoice = new Invoice();
    $invoice->setAmount($data['amount']);
    $invoice->setStatus($data['status'] ?? 'issued');
    $invoice->setPatientId($data['patientId']);
    $invoice->setIssuedAt(new \DateTime());

    $this->entityManager->persist($invoice);
    $this->entityManager->flush();


    return $invoice;
  }
}
