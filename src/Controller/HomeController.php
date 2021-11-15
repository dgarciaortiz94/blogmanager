<?php

namespace App\Controller;

use App\Entity\Podcast;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $podcastRepository = $this->getDoctrine()->getRepository(Podcast::class);
        $treeLastPodcasts = $podcastRepository->getLastPodcasts(3);

        return $this->render('home/index.html.twig', [
            'notCrudButtons' => true,
            'podcasts' => $treeLastPodcasts
        ]);
    }
}
