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
    public function sendMail(Request $request, \Swift_Mailer $mailer)
    {
        $email = $request->request->get('email');
        $name = $request->request->get('name');
        $obj = $request->request->get('obj');
        $msg = $request->request->get('msg');

        $message = (new \Swift_Message($obj))
            ->setFrom($email)
            ->setTo('k.alonso@iia-laval.fr')
            ->setBody($msg);

        $mailer->send($message);
        
        return new JsonResponse(array(
            'status' => 'OK',
        ),
        200);
    }

}