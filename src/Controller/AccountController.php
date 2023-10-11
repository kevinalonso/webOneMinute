<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Announcement;
use App\Entity\User;
use App\Entity\Bank;
use App\Entity\Offer;
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

        $ribs = $this->getDoctrine()->getRepository(Bank::class)
            ->getRibUser($user->getId());

        $buyList = $this->getDoctrine()->getRepository(Announcement::class)
            ->getAnnouncementBuy($user->getId());

        $offer = $this->getDoctrine()->getRepository(Offer::class)
            ->getOfferBuy($user->getId());

        $stats = $this->getDoctrine()->getRepository(Announcement::class)
            ->getStatistics($user->getId());

        $statsByCat = $this->getDoctrine()->getRepository(Announcement::class)
            ->getStatisticsByCat($user->getId());

        
        $stateOffer = "";
        if (!empty($offer)) {
            
            $endDate = clone $offer[1]->getDateofSale();

            if ($offer[0]->getMonth()) {
                $endDate = $endDate->modify('+1 month');
            }

            if ($offer[0]->getYear()) {
                $endDate = $endDate->modify('+1 year');
            }
            

            if (new \DateTime() < $endDate) {
                $stateOffer = "Abonnement toujours valide";
            } else {
                $stateOffer = "Abonnement expiré merci de renouveler";
            }  
        } else {
            $stateOffer = "Pas d'abonnement";
        }
        
        $valide = "";
        if (!empty($offer)) {
            if ($offer[0]->getMonth()) {

                $valide = clone $offer[1]->getDateofSale();
                $valide = $valide->modify('+1 month');
            }

            if ($offer[0]->getYear()) {
                
                $valide = clone $offer[1]->getDateofSale();
                $valide = $valide->modify('+1 year');
            }
            
        }
        
        foreach ($announcements as $item) {
            $path = str_replace("/home/minutee/www","",$item->getImage());

            $item->setImage($path);
        }

        return $this->render('account.html.twig', [
            'announcements'=> $announcements,
            'buyList'=> $buyList,
            'user' => $user,
            'ribs' => $ribs,
            'offer' => $offer,
            'offerState' => $stateOffer,
            'valide' => $valide,
            'stats' => $stats,
            'statsByCat' => $statsByCat
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

    public function editAccountView(UserInterface $user): Response
    {
        return $this->render('editaccount.html.twig', [
             'user' => $user
        ]);
    }

    public function editUser(Request $request,UserInterface $user,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $updateUser = new User();
       
        $updateUser->setId($user->getId());
        $updateUser->setFirstName($request->request->get('firstname'));
        $updateUser->setLastName($request->request->get('lastname'));
        $updateUser->setEmail($request->request->get('email'));
        $updateUser->setPassword($request->request->get('password'));
        $updateUser->setCity($request->request->get('city'));
        $updateUser->setCodePoste($request->request->get('cp'));
        $updateUser->setPhone($request->request->get('phone'));
        $updateUser->setAddress($request->request->get('address'));

        $password = $passwordEncoder->encodePassword($updateUser, $updateUser->getPassword());
        $updateUser->setPassword($password);

        if ($request->request->get('pro')) {
            $updateUser->setSiret($request->request->get('siret'));
            $updateUser->setFactory($request->request->get('factory'));
            $updateUser->setIsPro($request->request->get('pro'));
        } else {
             $updateUser->setIsPro(false);
        }


        $this->getDoctrine()->getRepository(User::class)
            ->updateUser($updateUser);        

       return $this->redirectToRoute('account');
    }
}