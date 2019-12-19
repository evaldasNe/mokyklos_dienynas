<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\GradeFilterType;
use App\Repository\UserRepository;
use App\Repository\ScheduleRepository;
use App\Repository\HomeWorkRepository;
use App\Repository\AchievementRepository;
use App\Repository\AttendanceRepository;
use App\Repository\ObservationRepository;
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
    public function showStudentHomework(HomeWorkRepository $homeWorkRepository, UserRepository $userRepository)
    {
        return $this->render('parent/studentHomework.html.twig', [
            'users' => $userRepository->findByRole('STUDENT'),
            'homeWorks' => $homeWorkRepository->findBySubject('Matematika'),
        ]);
    }

    /**
     * @Route("/studentGradeList", name="parent_studentGradeList")
     */
    public function showStudentGradeList(AchievementRepository $achievementRepository, AttendanceRepository $attendanceRepository, Request $request): Response
    {
        $form = $this->createForm(GradeFilterType::class);
        $form->handleRequest($request);
        $adminId = $this->getUser()->getEmail();

        if ($form->isSubmitted() && $form->isValid()){
            $date = $request->request->get('grade_filter')['date'];
            $users = $achievementRepository->findByDateAndStudent($adminId, $date);
        } else {
            $users = $achievementRepository->findByStudent($adminId);
        }

        return $this->render('student/gradelist.html.twig', [
        'users' => $users,
        'adminId' => $adminId,
        'form' => $form->createView(),
        'currentRoute' => 'student_gradelist',
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
    public function showStudentTimetable(ScheduleRepository $scheduleRepository, UserRepository $userRepository)
    {
        return $this->render('parent/studentTimetable.html.twig', [
            'users' => $userRepository->findByRole('STUDENT'),
            'schedules' => $scheduleRepository->findByRole('STUDENT'),
        ]);
    }
}