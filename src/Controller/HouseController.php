<?php

namespace App\Controller;

use App\Repository\HouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HouseController extends AbstractController
{
    #[Route('/api/houses', name: 'houses',methods: ['GET'])]
    public function getAllHouses(HouseRepository $houseRepository, SerializerInterface $serializer): JsonResponse
    {
        $houses = $serializer->serialize($houseRepository->findAll(),'json');
        return new JsonResponse(
            $houses,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
