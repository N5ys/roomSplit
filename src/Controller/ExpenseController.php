<?php

namespace App\Controller;

use App\Repository\ExpenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ExpenseController extends AbstractController
{
    #[Route('/api/expenses', name: 'expenses',methods: ['GET'])]
    public function getAllExpenses(ExpenseRepository $expenseRepository, SerializerInterface $serializer): JsonResponse
    {
        $expenses = $serializer->serialize($expenseRepository->findAll(), 'json');
        return new JsonResponse(
            $expenses,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
