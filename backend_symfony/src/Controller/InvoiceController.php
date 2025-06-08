<?php

namespace App\Controller;

use App\Entity\Invoice;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InvoiceController extends AbstractController
{
    #[Route('/api/invoices', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $invoice = new Invoice();
        $invoice->setAmount($data['amount']);
        $invoice->setStatus($data['status'] ?? 'issued');
        $invoice->setPatientId($data['patientId']);
        $invoice->setIssuedAt(new \DateTime());

        $em->persist($invoice);
        $em->flush();

        return $this->json(['id' => $invoice->getId()]);
    }

    #[Route('/api/invoices', methods: ['GET'])]
    public function list(EntityManagerInterface $em): JsonResponse
    {
        $invoices = $em->getRepository(Invoice::class)->findAll();
        $data = [];

        foreach ($invoices as $invoice) {
            $data[] = [
                'id' => $invoice->getId(),
                'amount' => $invoice->getAmount(),
                'status' => $invoice->getStatus(),
                'patientId' => $invoice->getPatientId(),
                'issuedAt' => $invoice->getIssuedAt()->format('Y-m-d H:i:s'),
            ];
        }

        return $this->json($data);
    }
}
