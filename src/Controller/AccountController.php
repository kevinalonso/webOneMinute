<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
	/**
	* @Route("/account")
	*/
	public function account(): Response
    {
        $annoucements = [];

    	return $this->render('account.html.twig', [
            'announcements'=> $annoucements
        ]);
    }
}