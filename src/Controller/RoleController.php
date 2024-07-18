<?php

namespace App\Controller;

use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RoleController extends AbstractController
{
    #[Route('/api/roles', name: 'roles',methods: ['GET'])]
    public function getAllRoles(RoleRepository $roleRepository, SerializerInterface $serializer): JsonResponse
    {
        $roles = $serializer->serialize($roleRepository->findAll(),'json');
        return new JsonResponse(
            $roles,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
