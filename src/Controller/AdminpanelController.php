<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Podcast;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin-panel")
 */
class AdminpanelController extends AbstractController
{
    /**
     * @Route("/", name="adminpanel.index")
     */
    public function index(): Response
    {
        return $this->render('adminpanel/index.html.twig', [
            'controller_name' => 'AdminpanelController',
        ]);
    }


    /**
     * @Route("/usuarios", name="adminpanel.show_users")
     *
     */
    public function showUsers(): Response
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $userRepository->findAll();

        return $this->render('adminpanel/showUsers.html.twig', [
            'users' => $users
        ]);
    }


    /**
     * @Route("/podcasts", name="adminpanel.show_podcasts")
     */
    public function showPodcasts(): Response
    {
        $podcastRepository = $this->getDoctrine()->getRepository(Podcast::class);
        $podcasts = $podcastRepository->findAll();

        return $this->render('adminpanel/showPodcasts.html.twig', [
            'podcasts' => $podcasts
        ]);
    }

}
