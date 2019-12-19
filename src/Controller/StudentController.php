<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\GradeFilterType;
use App\Form\UserType;
use App\Repository\AchievementRepository;
use App\Repository\AttendanceRepository;
use App\Repository\ObservationRepository;
use App\Repository\ScheduleRepository;
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
     * @Route("/remark", name="student_remark")
     */
    public function showAllTeachers(ObservationRepository $observationRepository)
    {

        $studentId = $this->getUser()->getId();
        $registry = $observationRepository->findByAddressee($studentId);

            return $this->render('student/remark.html.twig', [
                'users' => $registry,
                'currentRoute' => 'student_remark']);
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
    public function showAllParents(ScheduleRepository $scheduleRepository)
    {

        $studentId = $this->getUser()->getEmail();
        $registry = $scheduleRepository->findByEmailAndDay($studentId);

        return $this->render('student/timetable.html.twig', [
            'users' => $registry,
            'currentRoute' => 'student_timetable']);
    }

    /**
     * @Route("/gradelist", name="student_gradelist", methods={"GET", "POST"})
     */
    public function showgradelist(AchievementRepository $achievementRepository,AttendanceRepository $attendanceRepository, Request $request): Response
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
     * @Route("/teacherlist", name="student_teacherlist")
     */
    public function showTeachers(UserRepository $userRepository)
    {
        return $this->render('student/teacherlist.html.twig', [
            'users' => $userRepository->findByRole("TEACHER")
        ]);
    }
    /**
     * @Route("/messenger", name="student_messenger")
     */
    public function Messenger(UserRepository $userRepository)
    {
        return $this->render('student/messenger.html.twig', [
            'users' => $userRepository->findByRole('PARENT'),
        ]);
    }
}
