<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

    /**
     * @Route("/user/create", methods={"POST"})
     */
    public function create(
        EntityManagerInterface $em,
        ValidatorInterface $validator
    ): Response
    {
        $user = new User();
        $user->setEmail('sieg.alexandre@gmail.com');
        $user->setUsername(null);
        $user->setPassword('19Fe2502f52/');
        $user->setRoleId(1);

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $em->persist($user);

        $em->flush();

        return $this->json($user);
    }
}
