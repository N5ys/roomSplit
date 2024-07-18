<?php

namespace App\Controller;

use App\Repository\RoommateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RoommateController extends AbstractController
{
    #[Route('/api/roommates', name: 'roommates',methods: ['GET'])]
    public function getAllRoommates(RoommateRepository $roommateRepository, SerializerInterface $serializer): JsonResponse
    {
        $roommates = $serializer->serialize($roommateRepository->findAll(),'json');
        return new JsonResponse(
            $roommates,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
