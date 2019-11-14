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
 * @Route("/messenger")
 */
class MessengerController extends AbstractController
{
    /**
     * @Route("/openmesseges", name="messenger_openmesseges")
     */

    public function Messengers(UserRepository $userRepository)
    {
        return $this->render('messenger/openmesseges.html.twig', [
            'users' => $userRepository->findByRole('ADMIN')
        ]);
    }

    /**
     * @Route("/privatemesseges", name="messenger_privatemesseges")
     */

    public function Messengers2(UserRepository $userRepository)
    {
        return $this->render('messenger/privatemesseges.html.twig', [
            'users' => $userRepository->findByRole('STUDENT')
        ]);
    }

    /**
     * @Route("/writemesseges", name="messenger_writemesseges")
     */

    public function WriteMessege(UserRepository $userRepository)
    {
        return $this->render('messenger/writemesseges.html.twig', [
            'users' => $userRepository->findByRole('STUDENT')
        ]);
    }
}
