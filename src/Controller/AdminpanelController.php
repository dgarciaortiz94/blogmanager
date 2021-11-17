<?php

namespace App\Controller;

use App\Entity\Comment;
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
     * @Route("/usuarios", name="adminpanel.show_users")
     *
     */
    public function showUsers(): Response
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $userRepository->findAll();

        return $this->render('adminpanel/showUsers.html.twig', [
            'users' => $users,
            'statistics' => $this->getStatistics()
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
            'podcasts' => $podcasts,
            'statistics' => $this->getStatistics()
        ]);
    }



    public function getStatistics()
    {
        $userRepository          = $this->getDoctrine()->getRepository(User::class);
        $podcastRepository       = $this->getDoctrine()->getRepository(Podcast::class);
        $commentRepository       = $this->getDoctrine()->getRepository(Comment::class);

        $users = $userRepository->findAll();
        $podcasts = $podcastRepository->findAll();
        $comments = $commentRepository->findAll();

        $registeredUsersNumber   = count($users);
        $activeUsersNumber       = count(array_filter($users, function($i) { return $i->getIsActive() == true; }));
        $inactiveUsersNumber     = count(array_filter($users, function($i) { return $i->getIsActive() == false; }));

        $podcastsNumber          = count($podcasts);
        $activePodcastsNumber    = count(array_filter($podcasts, function($i) { return $i->getIsActive() == true; }));
        $inactivePodcastsNumber  = count(array_filter($podcasts, function($i) { return $i->getIsActive() == false; }));

        $commentsNumber          = count($comments);
        $commentsActiveNumber    = count(array_filter($comments, function($i) { return $i->getIsActive() == true; }));
        $commentsInactiveNumber  = count(array_filter($comments, function($i) { return $i->getIsActive() == false; }));

        $statistics = [
            "USUARIOS" => [
                "Usuarios registrados"   =>  $registeredUsersNumber,
                "Usuarios activos"       =>  $activeUsersNumber,
                "Usuarios bloqueados"     =>  $inactiveUsersNumber
            ],
            "PODCASTS" => [
                "Podcasts"          =>  $podcastsNumber,
                "Podcasts activos"    =>  $activePodcastsNumber,
                "Podcasts bloqueados"  =>  $inactivePodcastsNumber
            ],
            "COMENTARIOS" => [
                "Comentarios"          =>  $commentsNumber,
                "Comentarios activos"    =>  $commentsActiveNumber,
                "Comentarios bloqueados"  =>  $commentsInactiveNumber
            ]
        ];

        return $statistics;
    }

}
