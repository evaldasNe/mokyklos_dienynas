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
 * @Route("/student")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/remarks", name="student_remark")
     */
    public function showAllTeachers(UserRepository $userRepository)
    {

        return $this->render('student/remark.html.twig', [
            'users' => $userRepository->findByRole('TEACHER')

        ]);
    }
    /**
     * @Route("/homework", name="student_homework")
     */
    public function showAllStudents(UserRepository $userRepository)
    {
        return $this->render('student/homework.html.twig', [
            'users' => $userRepository->findByRole('ADMIN')
        ]);
    }
    /**
     * @Route("/timetable", name="student_timetable")
     */
    public function showAllParents(UserRepository $userRepository)
    {

        return $this->render('student/timetable.html.twig', [
            'users' => $userRepository->findByRole('PARENT'),
        ]);
    }

    /**
     * @Route("/gradelist", name="student_gradelist")
     */
    public function showgradelist(UserRepository $userRepository)
    {

        return $this->render('student/gradelist.html.twig', [
            'users' => $userRepository->findByRole('PARENT'),
        ]);
    }

    /**
     * @Route("/teacherlist", name="student_teacherlist")
     */
    public function showTeachers(UserRepository $userRepository)
    {
        return $this->render('student/teacherlist.html.twig', [
            'users' => $userRepository->findByRole("TEACHER")
        ]);
    }
    /**
     * @Route("/student/messenger", name="student_messenger")
     */
    public function Messenger(UserRepository $userRepository)
    {
        return $this->render('student/messenger.html.twig', [
            'users' => $userRepository->findByRole('PARENT'),
        ]);
    }

    /**
     * @Route("/anyUser/{id}/{nextRoute}", name="admin_delete", methods={"DELETE"})
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

        return $this->redirectToRoute($request->get('nextRoute'));
    }
}
