<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Bank;
use Symfony\Component\HttpFoundation\JsonResponse;

class RibController extends AbstractController
{
	/**
    * @Route("/account/create/rib")
    */
    public function createView(): Response
    {
        return $this->render('createrib.html.twig', []);
    }

   /** 
   * @Route("/createrib") 
   */ 
    public function create(Request $request,UserInterface $user) :Response
    {
    	$rib = new Bank();

    	$rib->setIban($request->request->get('iban'));
    	$rib->setBic($request->request->get('bic'));
        $rib->setUser($user);

    	$this->getDoctrine()->getRepository(Bank::class)
            ->insertRib($rib);

    	return new JsonResponse(array(
            'status' => 'OK',
        ),
        200);
    }

    public function editBankView(int $id): Response
    {

        $ribs = $this->getDoctrine()->getRepository(Bank::class)
            ->getRibFromUser($id);

        return $this->render('editbank.html.twig', [
             'rib' => $ribs
        ]);
    }

    public function editBank(Request $request, UserInterface $user): Response
    {
        dump(1);
        $updateBank = new Bank();

        $updateBank->setId($request->request->get('id'));
        $updateBank->setIban($request->request->get('iban'));
        $updateBank->setBic($request->request->get('bic'));
        $updateBank->setUser($user);

        dump($updateBank);

        $this->getDoctrine()->getRepository(Bank::class)
            ->updateBank($updateBank);        

       //return $this->redirectToRoute('account');
        return new JsonResponse(array(
            'status' => 'OK',
        ),
        200);
    }
}