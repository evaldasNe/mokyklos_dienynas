<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/teachers", name="admin_teachers")
     */
    public function showAllTeachers(UserRepository $userRepository)
    {
        $adminId = $this->getUser()->getId();

        return $this->render('admin/teachers.html.twig', [
            'users' => $userRepository->findAll(),
            'adminId' => $adminId,
        ]);
    }

    /**
     * @Route("/teachers/new", name="admin_teacher_new")
     */
    public function createTeacher(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_teachers');
        }

        return $this->render('admin/teacher_new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/anyUser/{id}", name="admin_delete", methods={"DELETE"})
     */
    public function deleteAnyUser(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))
            && $this->getUser()->getId() !== $user->getId())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_teachers');
    }
}
