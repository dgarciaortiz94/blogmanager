<?php

namespace App\Controller;

use App\Entity\Podcast;
use App\Form\PodcastType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
        return $this->render('userarea/index.html.twig', [
            'controller_name' => 'UserareaController',
        ]);
    }


    /**
     * @Route("/mis-podcasts", name="user_podcasts")
     */
    public function showPodcasts($user = null): Response
    {
        return $this->render('userarea/podcasts.html.twig', [
            'controller_name' => 'UserareaController',
        ]);
    }


    /**
     * @Route("/crear-podcast", name="user_create_podcast")
     */
    public function createPodcasts(Request $request, $user = null): Response
    {
        $podcast = new Podcast();

        $form = $this->createForm(PodcastType::class, $podcast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $podcast->setTitle($form->get('title')->getData());
            $podcast->setDescription($form->get('description')->getData());
            
            // I HAVE TO HANDLE TO THIS FILES
            // $podcast->setAudio($form->get('audio')->getData());
            // $podcast->setPicture($form->get('picture')->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($podcast);
            $entityManager->flush();

            return $this->redirectToRoute('user_podcasts');
        }

        return $this->render('userarea/createPodcast.html.twig', [
            'PodcastForm' => $form->createView(),
        ]);
    }
}
