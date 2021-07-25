<?php

namespace App\Controller;

use App\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends AbstractController
{

	/**
	* @Route("/offer")
	*/
	public function offerList(): Response
    {

    	$offers = $this->getDoctrine()->getRepository(Offer::class)
            ->allOffers();

    	return $this->render('offerlist.html.twig', [
    		'offers'=>$offers
    	]);
    }

}