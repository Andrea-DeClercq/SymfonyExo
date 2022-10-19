<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $em): Response
    {
        $listUser = $em->getRepository(User::class)->findAll();
        // dd($listUser);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'listUser' => $listUser,
        ]);
    }

    /**
     * Index User by ID
     *
     * @Route("/user/{id}", name="user_id") 
     * @param integer $id
     * @param EntityManagerInterface $em
     * @return User
     */
    public function indexByUser(int $id, EntityManagerInterface $em){
        $user = $em->getRepository(User::class)->find($id);
        // dd($user);
        return $this->render('home/user_detail.html.twig', [
            'name' => $user->getName(),
            'lastname' => $user->getLastName(),
            'phoneNumber' => $user->getPhoneNumber(),
        ]);
    }
}
