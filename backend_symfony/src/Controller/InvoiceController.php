<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Service\InvoiceService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\SendEmailMessage;

class InvoiceController extends AbstractController
{
    private InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    #[Route('/api/invoices', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        // $data = json_decode($request->getContent(), true);

        // $invoice = new Invoice();
        // $invoice->setAmount($data['amount']);
        // $invoice->setStatus($data['status'] ?? 'issued');
        // $invoice->setPatientId($data['patientId']);
        // $invoice->setIssuedAt(new \DateTime());

        // $em->persist($invoice);
        // $em->flush();

        // return $this->json(['id' => $invoice->getId()]);
        // $data = json_decode($request->getContent(), true);
        // $this->invoiceService->create($data);
        // return $this->json(['status' => 'created']);
        try {
            $data = json_decode($request->getContent(), true);

            if (!is_array($data)) {
                return new JsonResponse(['error' => 'Invalid JSON input.'], 400);
            }

            $invoice = $this->invoiceService->create($data);

            return new JsonResponse([
                'message' => 'Invoice created successfully',
                'id' => $invoice->getId()
            ], 201);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
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
                'patient_email' => $invoice->getPatientEmail(),
                'description' => $invoice->getDescription(),
                'issuedAt' => $invoice->getIssuedAt()->format('Y-m-d H:i:s'),
            ];
        }

        return $this->json($data);
    }

    #[Route('/api/invoices/{id}/send-email', methods: ['POST'])]
    public function sendEmail(Invoice $invoice, MessageBusInterface $bus): JsonResponse
    {
        $bus->dispatch(new SendEmailMessage($invoice->getId()));
        return $this->json(['status' => 'queued']);
    }
}
