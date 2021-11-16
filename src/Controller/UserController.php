<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminpanel.show_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/enable/{id}", name="user_enable", methods={"POST"})
     */
    public function enableUser(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('enable'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $user->setIsActive(true);
            
            $entityManager->flush();
        }

        return $this->redirectToRoute('adminpanel.show_users', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/disable/{id}", name="user_disable", methods={"POST"})
     */
    public function disableUser(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('disable'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $user->setIsActive(false);
            
            $entityManager->flush();
        }

        return $this->redirectToRoute('adminpanel.show_users', [], Response::HTTP_SEE_OTHER);
    }
}
