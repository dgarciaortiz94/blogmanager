<?php

namespace App\Controller;

use App\Entity\Podcast;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisplaypodcastController extends AbstractController
{
    /**
     * @Route("/ver-podcast/{podcastName}", name="displaypodcast")
     */
    public function index($podcastName): Response
    {
        $podcastName = str_replace("-", " ",$podcastName);
        $podcastRepository = $this->getDoctrine()->getRepository(Podcast::class);
        $podcast = $podcastRepository->findOneBy(array('title' => $podcastName));

        return $this->render('displaypodcast/index.html.twig', [
            'podcast' => $podcast
        ]);
    }
}
