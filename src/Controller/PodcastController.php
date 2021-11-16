<?php

namespace App\Controller;

use App\Entity\Podcast;
use App\Form\Podcast1Type;
use App\Repository\PodcastRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/podcast")
 */
class PodcastController extends AbstractController
{
    /**
     * @Route("/", name="podcast_index", methods={"GET"})
     */
    public function index(PodcastRepository $podcastRepository): Response
    {
        return $this->render('podcast/index.html.twig', [
            'podcasts' => $podcastRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="podcast_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $podcast = new Podcast();
        $form = $this->createForm(Podcast1Type::class, $podcast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($podcast);
            $entityManager->flush();

            return $this->redirectToRoute('podcast_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('podcast/new.html.twig', [
            'podcast' => $podcast,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="podcast_show", methods={"GET"})
     */
    public function show(Podcast $podcast): Response
    {
        return $this->render('podcast/show.html.twig', [
            'podcast' => $podcast,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="podcast_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Podcast $podcast): Response
    {
        $form = $this->createForm(PodcastType::class, $podcast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('podcast_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('podcast/edit.html.twig', [
            'podcast' => $podcast,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/enable/{id}", name="podcast_enable", methods={"POST"})
     */
    public function enablePodcast(Request $request, Podcast $podcast): Response
    {
        if ($this->isCsrfTokenValid('enable'.$podcast->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $podcast->setIsActive(true);

            $entityManager->flush();
        }

        return $this->redirectToRoute('adminpanel.show_podcasts', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/disable/{id}", name="podcast_disable", methods={"POST"})
     */
    public function disablePodcast(Request $request, Podcast $podcast): Response
    {
        if ($this->isCsrfTokenValid('disable'.$podcast->getId(), $request->request->get('_token'))) {
            echo ("pasa por aquí");
            $entityManager = $this->getDoctrine()->getManager();
            
            $podcast->setIsActive(false);

            $entityManager->flush();
        }

        return $this->redirectToRoute('adminpanel.show_podcasts', [], Response::HTTP_SEE_OTHER);
    }
}
