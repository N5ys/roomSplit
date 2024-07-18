<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EventController extends AbstractController
{
    #[Route('/api/events', name: 'events',methods: ['GET'])]
    public function getAllEvents(EventRepository $eventRepository, SerializerInterface $serializer): JsonResponse
    {
        $events = $serializer->serialize($eventRepository->findAll(), 'json') ;
        return new JsonResponse(
            $events,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
