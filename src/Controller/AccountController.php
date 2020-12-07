<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Announcement;

class AccountController extends AbstractController
{
	/**
	* @Route("/account")
	*/
	public function account(UserInterface $user): Response
    {
        $announcements = $this->getDoctrine()->getRepository(Announcement::class)
            ->getAnnoucementFromUser($user->getId());

    	return $this->render('account.html.twig', [
            'announcements'=> $announcements,
            'user' => $user
        ]);
    }

    /**
    * @Route("/accountcreate")
    */
    public function createAccount(): Response
    {

        return $this->render('createaccount.html.twig', []);
    }

    /**
    * @Route("/account/delete/{id}")
    */
    public function delete(UserInterface $user,int $id): Response
    {
        $this->getDoctrine()->getRepository(Announcement::class)
            ->deleteAnnouncement($id);

        return $this->redirectToRoute('account');
    }
}