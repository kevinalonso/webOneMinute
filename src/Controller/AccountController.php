<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Announcement;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Collections\ArrayCollection;

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
   * @Route("/createuser") 
   */ 
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();

        $user->setFirstName($request->request->get('firstname'));
        $user->setLastName($request->request->get('lastname'));
        $user->setPhone($request->request->get('phone'));
        $user->setEmail($request->request->get('email'));
        $user->setSiret($request->request->get('siret'));
        $user->setFactory($request->request->get('factory'));
        $user->setAddress($request->request->get('address'));
        $user->setCodePoste($request->request->get('cp'));
        $user->setCity($request->request->get('city'));
        $user->setIsPro($request->request->get('ispro'));
        $user->setPassword($request->request->get('password'));

        $user->setIsActive(true);

        //crypt password
        $password = $passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($password);

        $this->getDoctrine()->getRepository(User::class)
            ->insertUser($user);

        return new JsonResponse(array(
            'status' => 'OK'
        ),
        200);
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