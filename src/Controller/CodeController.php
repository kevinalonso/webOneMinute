<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Code;
use App\Entity\Email;
use App\Entity\Sale;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class CodeController extends AbstractController
{
 
	/**
	* @Route("/code/{command}/{idUser}")
	*/
	public function code(string $command,int $idUser,\Swift_Mailer $mailer): Response
    {
        //Code random
        $codeGenerate = $this->generateRandomCode(6);
        $time = new \DateTime('now');

        //Save code and command link
        $code = new Code();
        $code->setCommand($command);
        $code->setCode($codeGenerate);
        $code->setDateStart($time);

        $moreFiveMinutes = new \DateTime('now');
        $moreFiveMinutes->modify('+5 minutes');

        $code->setDateEnd($moreFiveMinutes);

        $this->getDoctrine()->getRepository(Code::class)
            ->insert($code);

        //send mail
        $emailData = $this->getDoctrine()->getRepository(Email::class)
            ->getEmail("code");

        $email = $emailData[0]->getEmailAddress();
        $obj = $emailData[0]->getObject();
        $msg = $emailData[0]->getMessage();

        $msg = str_replace("@[code]", $codeGenerate, $msg);

        //get user email
        $user = $this->getDoctrine()->getRepository(User::class)
            ->getUserById($idUser);

        $message = (new \Swift_Message($obj))
            ->setFrom($email)
            ->setTo($user[0]->getEmail())
            ->setBody($msg);

        $mailer->send($message);


        //Page a afficher qui contient un zone de saisie et un bouton d'envoi

        return $this->render('code.html.twig', []);
    }

    /**
    * @Route("/codesend")
    */
    public function sendCode(Request $request): Response
    {
        //Controler le code transmis si il est toujours valide en temps et si il est bien saisie
        $dateNow = new \DateTime('now');
        $codeSend = $request->request->get('code');
        $codeValid = false;

        $codeFind = $this->getDoctrine()->getRepository(Code::class)
            ->getCode($codeSend);

        dump($codeSend);
        dump($codeFind);

        if ($codeFind[0]->getCode() == $codeSend) {
            $codeValid = true;

            //Update sale
            //$command = "PRLU8LWC7V";

            $this->getDoctrine()->getRepository(Sale::class)
            ->updateSale($command,"Service fait");
        }

        //Afficher confirmation de la saisie du code si OK sinon afficher une page d'erreur avec un bouton regénérer un code
        if ($codeValid) {
           return new JsonResponse(array('status' => 'OK',),200);
        } else {
            return new JsonResponse(array('status' => 'ERROR',),500);
        }
        
    }

    /**
    * @Route("/codeconfirmation")
    */
    public function codeConfirmation(Request $request): Response
    {
        return $this->render('codeconfirmation.html.twig', []);
    }

    private function generateRandomCode($length) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}