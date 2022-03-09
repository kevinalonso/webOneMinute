<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Payment;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Announcement;
use App\Entity\Email;
use App\Entity\Sale;
use App\Entity\Offer;
use App\Entity\Cgs;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class PaymentController extends AbstractController
{

	private $codeGenerated;

	/**
	* @Route("/payment/{id}/{type}")
	*/
	public function payment(int $id, bool $type): RedirectResponse
    {
    	$price = 0;
    	$cmd = "";
    	if ($type) {
    		
	    	$announcement = $this->getDoctrine()->getRepository(Announcement::class)
	            ->getAnnouncementById($id);

	        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
	        $userBuyer = $this->getUser();

	        //Create command
	    	$cmd = $this->generateRandomString(10);
	    	$this->codeGenerated = $cmd;
	    	$command = $this->getDoctrine()->getRepository(Sale::class)
	            ->insertSale($cmd,$announcement, $userBuyer,$type);

	        //Important il faut multiplier le prix par cent
	        $price = strval(($announcement[0]->getPrice() + ($announcement[0].Price * 5/100))*100);
    	}
    	else
    	{
    		$offer = $this->getDoctrine()->getRepository(Offer::class)
    			->getOfferById($id);

    		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
	        $userBuyer = $this->getUser();

	        //Create command
	    	$cmd = $this->generateRandomString(10);
	    	$command = $this->getDoctrine()->getRepository(Sale::class)
	            ->insertSale($cmd,$offer, $userBuyer,$type);

	    	//Insert offer in database
	    	
	    	
	        //Important il faut multiplier le prix par cent
	        $price = strval(($offer[0]->getPrice() + ($offer[0].Price * 5/100))*100);
    	}

    	//Paybox
    	$settingPbx = $this->getDoctrine()->getRepository(Payment::class)
            ->getSettingPbx();

    	$pbx_site = $settingPbx[0]->getPbxSite();//'1999888'; //variable de test 1999888
		$pbx_rang = $settingPbx[0]->getPbxRang();//'32'; //variable de test 32
		$pbx_identifiant = $settingPbx[0]->getPbxIdentifiant();//'3'; //variable de test 3
		$pbx_cmd = $command;//$announcement[0]->getTitle();
		$pbx_porteur = 'test@test.fr'; //mail de l'acheteur
		$pbx_total = $price; //variable de test 100
		$pbx_devise = $settingPbx[0]->getPbxDevise();//'978';
		$pbx_hash = $settingPbx[0]->getPbxHash();//'SHA512';

		$pbx_serveur_primaire = $settingPbx[0]->getServeurPrimaire();
		$pbx_serveur_secondaire = $settingPbx[0]->getServeurSecondaire();

		// Suppression des points ou virgules dans le montant						
		$pbx_total = str_replace(",", "", $pbx_total);
		$pbx_total = str_replace(".", "", $pbx_total);

		// Paramétrage des urls de redirection après paiement
		$pbx_effectue = $settingPbx[0]->getPbxEffectue();//'http://www.votre-site.extention/page-de-confirmation';
		$pbx_annule = $settingPbx[0]->getPbxAnnule();//'http://www.votre-site.extention/page-d-annulation';
		$pbx_refuse = $settingPbx[0]->getPbxRefuse();//'http://www.votre-site.extention/page-de-refus';

		// Paramétrage de l'url de retour back office site
		$pbx_repondre_a = $settingPbx[0]->getPbxRepondreA();//'http://www.votre-site.extention/page-de-back-office-site';

		// Paramétrage du retour back office site
		$pbx_retour = $settingPbx[0]->getPbxRetour();//'Mt:M;Ref:R;Auto:A;Erreur:E';

		$keyTest = $settingPbx[0]->getHMAC();

		$serveurs = array($pbx_serveur_primaire, //serveur primaire
		$pbx_serveur_secondaire); //serveur secondaire
		
		$serveurOK = "";

		//phpinfo(); <== voir paybox
		foreach($serveurs as $serveur){
			$doc = new \DOMDocument();
			$doc->loadHTMLFile('https://'.$serveur.'/load.html');
			$server_status = "";
			$element = $doc->getElementById('server_status');

			if($element){
				$server_status = $element->textContent;
			}

			if($server_status == "OK"){
				// Le serveur est prêt et les services opérationnels
				$serveurOK = $serveur;
				break;
			}
		}
		//curl_close($ch); <== voir paybox
		if(!$serveurOK){
			die("Erreur : Aucun serveur n'a été trouvé");
		}

		// Activation de l'univers de préproduction
		//$serveurOK = 'preprod-tpeweb.paybox.com';

		//Création de l'url cgi paybox
		$serveurOK = 'https://'.$serveurOK.'/cgi/MYchoix_pagepaiement.cgi';

		// On récupère la date au format ISO-8601
		$dateTime = date("c");

		// On crée la chaîne à hacher sans URLencodage
		$msg = "PBX_SITE=".$pbx_site.
		"&PBX_RANG=".$pbx_rang.
		"&PBX_IDENTIFIANT=".$pbx_identifiant.
		"&PBX_TOTAL=".$pbx_total.
		"&PBX_DEVISE=".$pbx_devise.
		"&PBX_CMD=".$pbx_cmd.
		"&PBX_PORTEUR=".$pbx_porteur.
		"&PBX_REPONDRE_A=".$pbx_repondre_a.
		"&PBX_RETOUR=".$pbx_retour.
		"&PBX_EFFECTUE=".$pbx_effectue.
		"&PBX_ANNULE=".$pbx_annule.
		"&PBX_REFUSE=".$pbx_refuse.
		"&PBX_HASH=".$pbx_hash.
		"&PBX_TIME=".$dateTime;

		// Si la clé est en ASCII, On la transforme en binaire
		$binKey = pack("H*", $keyTest);

		$hmac = strtoupper(hash_hmac('sha512', $msg, $binKey));

		$paybox = [
			'PBX_SITE'=>$pbx_site,
			'PBX_RANG'=>$pbx_rang,
			'PBX_IDENTIFIANT'=>$pbx_identifiant,
			'PBX_TOTAL'=>$pbx_total,
			'PBX_DEVISE'=>$pbx_devise,
			'PBX_CMD'=>$pbx_cmd,
			'PBX_PORTEUR'=>$pbx_porteur,
			'PBX_REPONDRE_A'=>$pbx_repondre_a,
			'PBX_RETOUR'=>$pbx_retour,	
			'PBX_EFFECTUE'=>$pbx_effectue,
			'PBX_ANNULE'=>$pbx_annule,
			'PBX_REFUSE'=>$pbx_refuse,
			'PBX_HASH'=>$pbx_hash,
			'PBX_TIME'=>$dateTime,
			'PBX_HMAC'=>$hmac
		];

		$params = http_build_query($paybox);
      	
      	$httpClient = HttpClient::create();
      	/*$response = $httpClient->request('POST','https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi?'. $params);*/

		return new RedirectResponse('https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi?'. $params);
    }

    /**
	* @Route("/cart/{id}")
	*/
    public function cart(int $id, bool $type): Response
    {
    	$offer = null;
    	$cgv = $this->getDoctrine()->getRepository(Cgs::class)->getCgs();

    	if ($type) {
    		$announcement = $this->getDoctrine()->getRepository(Announcement::class)
            ->getAnnouncementById($id);

            return $this->render('cart.html.twig', [
    			'announcement' => $announcement,
    			'offer' => $offer,
    			'cgv' => $cgv[0]->getTextCgs()
        	]);
    	} else {
    		$offer = $this->getDoctrine()->getRepository(Offer::class)
    			->getOfferById($id);

    		return $this->render('cart.html.twig', [
    			'offer' => $offer,
    			'cgv' => $cgv[0]->getTextCgs()
        	]);
    	}
    }

    public function confirmation(Request $request,\Swift_Mailer $mailer,AuthenticationUtils $authenticationUtils): Response
    {	
    	//get response paybox
    	$montant = $request->query->get('Mt')/100;
    	$ref_com = $request->query->get('Ref');
    	$auto = $request->query->get('Auto');
    	$trans = $request->query->get('trans');

    	//$ttc = $montant * 1.20;

    	//Send mail confirmation
    	$emailData = $this->getDoctrine()->getRepository(Email::class)
            ->getEmail("confirmation");


    	$email = $emailData[0]->getEmailAddress();
        $obj = $emailData[0]->getObject();
        $msg = $emailData[0]->getMessage();

        //Ajouter le mail de l'utilisateur connecté
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userBuyerId = $this->getUser()->getId();


        //Get las command
        $code = $this->getDoctrine()->getRepository(Sale::class)
            ->getSale($this->getUser());

        $codeLink = "http://localhost/oneminute/public/code/".$code[0]->getCommand()."/".$userBuyerId;

        $msg = str_replace("@[link]", $codeLink, $msg);

        $msg = strip_tags($msg);

        $message = (new \Swift_Message($obj))
            ->setFrom($email)
            ->setTo($authenticationUtils->getLastUsername())
            ->setBody($msg);

        $mailer->send($message);

    	return $this->render('confirmation.html.twig', [
    		'montant' => $montant,
    		'ref_com' => $ref_com,
    		'auto' => $auto,
    		'trans' => $trans,
    		'data' => $request->query,
    		'msg' => $message
        ]);
    }

    private function generateRandomString($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}