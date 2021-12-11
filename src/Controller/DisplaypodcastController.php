<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Podcast;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisplaypodcastController extends AbstractController
{
    /**
     * @Route("/ver-podcast/{podcastName}", name="displaypodcast")
     */
    public function index(Request $request, $podcastName): Response
    {
        $podcastName = str_replace("-", " ",$podcastName);
        $podcastRepository = $this->getDoctrine()->getRepository(Podcast::class);
        $podcast = $podcastRepository->getOneByTitle($podcastName);

        $entityManager = $this->getDoctrine()->getManager();

        $commentsItems = $entityManager->getRepository(Comment::class)->getByPodcast($podcast->getId());
        $numComments = count($commentsItems);

        if (empty($podcast)) {
            echo "Este podcast no existe";
            die;
        }

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setPodcast($podcast);
            $comment->setUser($this->getUser());
            $comment->setIsActive(true);

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('displaypodcast/index.html.twig', [
            'podcast' => $podcast,
            'comment' => $comment,
            'form' => $form->createView(),
            'commentItems' => $commentsItems,
            'numComments' => $numComments
        ]);
    }
}
