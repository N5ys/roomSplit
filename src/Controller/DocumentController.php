<?php

namespace App\Controller;

use App\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DocumentController extends AbstractController
{
    #[Route('/api/documents', name: 'documents',methods: ['GET'])]
    public function getAllDocuments(DocumentRepository $documentRepository, SerializerInterface $serializer): JsonResponse
    {
        $documents = $serializer->serialize($documentRepository->findAll(),'json');
        return new JsonResponse(
            $documents,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
