<?php

namespace App\Controller;

use App\DataHelper\Statistics;
use App\DataHelper\StatisticsHelper;
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
        $doctrine = $this->getDoctrine();
        $podcastRepository = $doctrine->getRepository(User::class);

        $users = $podcastRepository->findAll();

        $statisticsHelper = new StatisticsHelper();

        return $this->render('adminpanel/showUsers.html.twig', [
            'users' => $users,
            'statistics' => $statisticsHelper->getStatistics($doctrine)
        ]);
    }


    /**
     * @Route("/podcasts/{user}", name="adminpanel.show_podcasts")
     */
    public function showPodcasts($user = null): Response
    {
        $doctrine = $this->getDoctrine();
        $podcastRepository = $doctrine->getRepository(Podcast::class);
        $userRepository = $doctrine->getRepository(User::class);
        
        if ($user != null) {
            $podcasts = $podcastRepository->getByUser($user);
        } else {
            $podcasts = $podcastRepository->findAll();
        }

        $statisticsHelper = new StatisticsHelper();

        return $this->render('adminpanel/showPodcasts.html.twig', [
            'podcasts' => $podcasts,
            'statistics' => $statisticsHelper->getStatistics($doctrine)
        ]);
    }

}
