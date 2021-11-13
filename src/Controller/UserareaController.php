<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/area-usuario/{user}")
 */
class UserareaController extends AbstractController
{
    /**
     * @Route("/", name="user_area")
     */
    public function index($user = null): Response
    {
        if (is_null($user)) return $this->redirectToRoute('home');
        else {
            return $this->render('userarea/index.html.twig', [
                'controller_name' => 'UserareaController',
            ]);
        }
    }


    /**
     * @Route("/podcasts", name="user_podcasts")
     */
    public function showPodcasts($user = null): Response
    {
        if (is_null($user)) return $this->redirectToRoute('home');
        else {
            return $this->render('userarea/podcasts.html.twig', [
                'controller_name' => 'UserareaController',
            ]);
        }
    }


    /**
     * @Route("/crear-podcasts", name="user_create_podcast")
     */
    public function createPodcasts($user = null): Response
    {
        if (is_null($user)) return $this->redirectToRoute('home');
        else {
            return $this->render('userarea/createPodcast.html.twig', [
                'controller_name' => 'UserareaController',
            ]);
        }
    }
}
