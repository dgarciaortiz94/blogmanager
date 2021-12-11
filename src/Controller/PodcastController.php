<?php

namespace App\Controller;

use App\DataHelper\FileHelper;
use App\Entity\Podcast;
use App\Entity\User;
use App\Form\PodcastType;
use App\Repository\PodcastRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/podcast")
 */
class PodcastController extends AbstractController
{
    /**
     * @Route("/{podcastName}", name="displaypodcast")
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

    /**
     * @Route("/new", name="podcast_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $podcast = new Podcast();
        $form = $this->createForm(PodcastType::class, $podcast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $picture = $form->get('image')->getData();
            $audio = $form->get('podcast')->getData();

            $fileHelper = new FileHelper();

            $newAudioFilename = $fileHelper->loadAudio($audio, $slugger);
            $newPictureFilename = $fileHelper->loadPicture($picture, $slugger);

            $user = $entityManager->find(User::class, $this->getUser()->getId());

            $podcast->setAudio($newAudioFilename);
            $podcast->setPicture($newPictureFilename);
            $podcast->setCreateDate(new DateTime());
            $podcast->setUser($user);
            $podcast->setIsActive(true);
            
            $entityManager->persist($podcast);
            $entityManager->flush();

            return $this->redirectToRoute('user_podcasts', [], Response::HTTP_SEE_OTHER);
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
    public function edit(Request $request, Podcast $podcast, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(PodcastType::class, $podcast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $picture = $form->get('image')->getData();
            $audio = $form->get('podcast')->getData();

            // HANDLE OF PICTURE
            if ($picture) {
                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $picture->move(
                        "images/podcasts",
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $podcast->setPicture($newFilename);
            }


            // HANDLE OF AUDIO
            if ($audio) {
                $originalFilename = pathinfo($audio->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$audio->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $audio->move(
                        "audios/podcasts",
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $podcast->setAudio($newFilename);
            }

            $entityManager->flush();

            $route = $this->isGranted('ROLE_ADMIN') ? 'adminpanel.show_podcasts' : 'user_podcasts';
            return $this->redirectToRoute($route, [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('podcast/new.html.twig', [
            'podcast' => $podcast,
            'form' => $form,
            'edit' => true
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
            $entityManager = $this->getDoctrine()->getManager();
            
            $podcast->setIsActive(false);

            $entityManager->flush();
        }

        $route = $this->isGranted('ROLE_ADMIN') ? 'adminpanel.show_podcasts' : 'user_podcasts';
        return $this->redirectToRoute($route, [], Response::HTTP_SEE_OTHER);
    }
}
