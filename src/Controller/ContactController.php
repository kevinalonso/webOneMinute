<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContactController extends AbstractController
{
 
	/**
	* @Route("/contact")
	*/
	public function contact(): Response
    {
        return $this->render('contact.html.twig', []);
    }

    /** 
   * @Route("/sendmail") 
    */ 
    public function sendMail(Request $request)
    {
        $email = $request->request->get('email');

        
        
        
        return new JsonResponse(array(
            'status' => 'OK',
        ),
        200);
    }

}