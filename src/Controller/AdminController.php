<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UsersFilterType;
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
     * @Route("/teachers", name="admin_teachers", methods={"GET", "POST"})
     */
    public function showAllTeachers(UserRepository $userRepository, Request $request): Response
    {
        $role = 'TEACHER';
        $form = $this->createForm(UsersFilterType::class);
        $form->handleRequest($request);
        $adminId = $this->getUser()->getId();

        if ($form->isSubmitted() && $form->isValid()){
            $last_name = $request->request->get('users_filter')['last_name'];

            $users = $userRepository->findByRoleAndLastName($role, $last_name);
        } else {
            $users = $userRepository->findByRole($role);
        }

        return $this->render('admin/teachers.html.twig', [
            'users' => $users,
            'adminId' => $adminId,
            'form' => $form->createView(),
            'currentRoute' => 'admin_teachers',
        ]);
    }

    /**
     * @Route("/teachers/new", name="admin_new_teacher")
     */
    public function createTeacher(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $user->setRoles(array("ROLE_TEACHER"));
            $user->setPassword(password_hash('password', 1));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_teachers');
        }

        return $this->render('admin/new_teacher.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/students", name="admin_students", methods={"GET", "POST"})
     */
    public function showAllStudents(UserRepository $userRepository, Request $request): Response
    {
        $role = 'STUDENT';
        $form = $this->createForm(UsersFilterType::class);
        $form->handleRequest($request);
        $adminId = $this->getUser()->getId();

        if ($form->isSubmitted() && $form->isValid()){
            $last_name = $request->request->get('users_filter')['last_name'];
            $users = $userRepository->findByRoleAndLastName($role, $last_name);
        } else {
            $users = $userRepository->findByRole($role);
        }

        return $this->render('admin/students.html.twig', [
            'users' => $users,
            'adminId' => $adminId,
            'form' => $form->createView(),
            'currentRoute' => 'admin_students',
        ]);
    }

    /**
     * @Route("/students/new", name="admin_new_student")
     */
    public function createStudent(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $user->setRoles(array("ROLE_STUDENT"));
            $user->setPassword(password_hash('password', 1));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_students');
        }

        return $this->render('admin/new_student.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/parents", name="admin_parents", methods={"GET", "POST"})
     */
    public function showAllParents(UserRepository $userRepository, Request $request): Response
    {
        $role = 'PARENT';
        $form = $this->createForm(UsersFilterType::class);
        $form->handleRequest($request);

        $adminId = $this->getUser()->getId();

        if ($form->isSubmitted() && $form->isValid()){
            $last_name = $request->request->get('users_filter')['last_name'];
            $users = $userRepository->findByRoleAndLastName($role, $last_name);
        } else {
            $users = $userRepository->findByRole($role);
        }

        return $this->render('admin/parents.html.twig', [
            'users' => $users,
            'adminId' => $adminId,
            'form' => $form->createView(),
            'currentRoute' => 'admin_parents',
        ]);
    }

    /**
     * @Route("/parents/new", name="admin_new_parent")
     */
    public function createParent(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $user->setRoles(array("ROLE_PARENT"));
            $user->setPassword(password_hash('password', 1));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_parents');
        }

        return $this->render('admin/new_parent.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admins", name="admin_admins", methods={"GET", "POST"})
     */
    public function showAllAdmins(UserRepository $userRepository, Request $request): Response
    {
        $role = 'ADMIN';
        $form = $this->createForm(UsersFilterType::class);
        $form->handleRequest($request);
        $adminId = $this->getUser()->getId();

        if ($form->isSubmitted() && $form->isValid()){
            $last_name = $request->request->get('users_filter')['last_name'];
            $users = $userRepository->findByRoleAndLastName($role, $last_name);
        } else {
            $users = $userRepository->findByRole($role);
        }

        return $this->render('admin/admins.html.twig', [
            'users' => $users,
            'adminId' => $adminId,
            'form' => $form->createView(),
            'currentRoute' => 'admin_admins',
        ]);
    }

    /**
     * @Route("/admins/new", name="admin_new_admin")
     */
    public function createAdmin(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $user->setRoles(array("ROLE_ADMIN"));
            $user->setPassword(password_hash('password', 1));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_admins');
        }

        return $this->render('admin/new_admin.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
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
