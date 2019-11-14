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
 * @Route("/parent")
 */
class ParentController extends AbstractController
{
    /**
     * @Route("/teacherList", name="parent_teacherList")
     */
    public function showAllTeachers(UserRepository $userRepository)
    {
        return $this->render('parent/teacherList.html.twig', [
            'users' => $userRepository->findByRole('TEACHER')
        ]);
    }

    /**
     * @Route("/studentRemark", name="parent_studentRemark")
     */
    public function showStudentRemark(UserRepository $userRepository)
    {
        return $this->render('parent/studentRemark.html.twig', [
            'users' => $userRepository->findByRole('STUDENT')
        ]);
    }

    /**
     * @Route("/studentHomework", name="parent_studentHomework")
     */
    public function showStudentHomework(UserRepository $userRepository)
    {
        return $this->render('parent/studentHomework.html.twig', [
            'users' => $userRepository->findByRole('STUDENT')
        ]);
    }

    /**
     * @Route("/studentGradeList", name="parent_studentGradeList")
     */
    public function showStudentGradeList(UserRepository $userRepository)
    {
        return $this->render('parent/studentGradeList.html.twig', [
            'users' => $userRepository->findByRole('STUDENT'),
        ]);
    }

    /**
     * @Route("/messenger", name="parent_messenger")
     */
    public function Messenger(UserRepository $userRepository)
    {
        return $this->render('student/messenger.html.twig', [
            'users' => $userRepository->findByRole('PARENT'),
        ]);
    }

    /**
     * @Route("/studentTimetable", name="parent_studentTimetable")
     */
    public function showStudentTimetable(UserRepository $userRepository)
    {
        return $this->render('parent/studentTimetable.html.twig', [
            'users' => $userRepository->findByRole('STUDENT'),
        ]);
    }
}