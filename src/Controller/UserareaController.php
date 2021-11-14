<?php

namespace App\Controller;

use App\Entity\Podcast;
use App\Entity\User;
use App\Form\PodcastType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/area-usuario")
 */
class UserareaController extends AbstractController
{

    /**
     * @Route("/", name="user_area")
     */
    public function index(): Response
    {
        return $this->render('userarea/index.html.twig', [
            'controller_name' => 'UserareaController',
        ]);
    }


    /**
     * @Route("/mis-podcasts", name="user_podcasts")
     */
    public function showPodcasts(): Response
    {
        $userId = $this->getUser()->getId();

        $podcastRepository = $this->getDoctrine()->getRepository(Podcast::class);

        $podcasts = $podcastRepository->getByUser($userId);

        return $this->render('userarea/podcasts.html.twig', [
            'podcasts' => $podcasts
        ]);
    }


    /**
     * @Route("/crear-podcast", name="user_create_podcast")
     */
    public function createPodcasts(Request $request, SluggerInterface $slugger): Response
    {
        $podcast = new Podcast();

        $form = $this->createForm(PodcastType::class, $podcast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->find(User::class, $this->getUser()->getId());

            $podcast->setCreateDate(new DateTime());
            $podcast->setUser($user);

            $entityManager->persist($podcast);
            $entityManager->flush();

            return $this->redirectToRoute('user_podcasts');
        }

        return $this->render('userarea/createPodcast.html.twig', [
            'PodcastForm' => $form->createView(),
        ]);
    }
}
