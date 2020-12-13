<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaxDeclarationController extends AbstractController
{
	/**
	* @Route("/declaration")
	*/
	public function declaration(): Response
	{
		return $this->render('tax.html.twig', []);
	}
}