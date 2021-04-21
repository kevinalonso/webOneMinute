<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PaymentController extends AbstractController
{
	/**
	* @Route("/payment")
	*/
	public function payment(): RedirectResponse
    {
    	//Ici mettre la requete en place pour compléter les valeur pour paybox


    	$pbx_site = '1999888'; //variable de test 1999888
		$pbx_rang = '32'; //variable de test 32
		$pbx_identifiant = '3'; //variable de test 3
		$pbx_cmd = 'cmd_test1'; //variable de test cmd_test1
		$pbx_porteur = 'test@test.fr'; //variable de test test@test.fr
		$pbx_total = '100'; //variable de test 100
		$pbx_devise = '978';
		$pbx_hash = 'SHA512';

		// Suppression des points ou virgules dans le montant						
		$pbx_total = str_replace(",", "", $pbx_total);
		$pbx_total = str_replace(".", "", $pbx_total);

		// Paramétrage des urls de redirection après paiement
		$pbx_effectue = 'http://www.votre-site.extention/page-de-confirmation';
		$pbx_annule = 'http://www.votre-site.extention/page-d-annulation';
		$pbx_refuse = 'http://www.votre-site.extention/page-de-refus';

		// Paramétrage de l'url de retour back office site
		$pbx_repondre_a = 'http://www.votre-site.extention/page-de-back-office-site';

		// Paramétrage du retour back office site
		$pbx_retour = 'Mt:M;Ref:R;Auto:A;Erreur:E';

		// Connection à la base de données
		// mysql_connect...
		// On récupère la clé secrète HMAC (stockée dans une base de données par exemple) et que l’on renseigne dans la variable $keyTest;
		$keyTest = '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF';

		$serveurs = array('tpeweb.paybox.com', //serveur primaire
		'tpeweb1.paybox.com'); //serveur secondaire
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
		return new RedirectResponse('https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi?'. $params);
    }
}