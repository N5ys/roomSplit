<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TaskController extends AbstractController
{
    #[Route('/api/tasks', name: 'tasks',methods: ['GET'])]
    public function getAllTasks(TaskRepository $taskRepository, SerializerInterface $serializer): JsonResponse
    {
        $tasks = $serializer->serialize($taskRepository->findAll(),'json');
        return new JsonResponse(
            $tasks,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
