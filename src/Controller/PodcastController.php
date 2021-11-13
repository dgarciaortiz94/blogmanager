<?php

namespace App\Controller;

use App\Entity\Podcast;
use App\Form\PodcastType;
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
     * @Route("/", name="podcast_show", methods={"GET"})
     */
    public function getAll()
    {
        return ;
    }


    /**
     * @Route("/{id}", name="podcast_show", methods={"GET"})
     */
    public function getById(int $id)
    {
        return $this->render('podcast/show.html.twig', [
            
        ]);
    }


    /**
     * @Route("/new", name="podcast_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $podcast = new Podcast();
        $form = $this->createForm(PodcastType::class, $podcast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($podcast);
            $entityManager->flush();

            return $this->redirectToRoute('user_podcasts', [], Response::HTTP_SEE_OTHER);
        }
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
     * @Route("/{id}", name="podcast_delete", methods={"POST"})
     */
    public function delete(Request $request, Podcast $podcast): Response
    {
        if ($this->isCsrfTokenValid('delete'.$podcast->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($podcast);
            $entityManager->flush();
        }

        return $this->redirectToRoute('podcast_index', [], Response::HTTP_SEE_OTHER);
    }
}
