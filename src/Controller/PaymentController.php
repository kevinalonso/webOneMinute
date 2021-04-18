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
		"&PBX_DEVISE=978".
		"&PBX_CMD=".$pbx_cmd.
		"&PBX_PORTEUR=".$pbx_porteur.
		"&PBX_REPONDRE_A=".$pbx_repondre_a.
		"&PBX_RETOUR=".$pbx_retour.
		"&PBX_EFFECTUE=".$pbx_effectue.
		"&PBX_ANNULE=".$pbx_annule.
		"&PBX_REFUSE=".$pbx_refuse.
		"&PBX_HASH=SHA512".
		"&PBX_TIME=".$dateTime;

		// Si la clé est en ASCII, On la transforme en binaire
		$binKey = pack("H*", $keyTest);

		$hmac = strtoupper(hash_hmac('sha512', $msg, $binKey));

		//Url a poster --> https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi?
		
		//PBX_SITE=1999888&
		
		//PBX_RANG=32&
		
		//PBX_IDENTIFIANT=3&
		
		//PBX_TOTAL=100&
		
		//PBX_DEVISE=978&
		
		//PBX_CMD=cmd_test1&
		
		//PBX_PORTEUR=test%40test.fr&
		
		//PBX_REPONDRE_A=http%3A%2F%2Fwww.votre-site.extention%2Fpage-de-back-office-site&
		
		//PBX_RETOUR=Mt%3AM%3BRef%3AR%3BAuto%3AA%3BErreur%3AE&
		
		/*PBX_EFFECTUE=http%3A%2F%2Fwww.votre-site.extention%2Fpage-de-confirmation&PBX_ANNULE=http%3A%2F%2Fwww.votre-site.extention%2Fpage-d-annulation&PBX_REFUSE=http%3A%2F%2Fwww.votre-site.extention%2Fpage-de-refus&PBX_HASH=SHA512&PBX_TIME=2021-04-18T22%3A41%3A42%2B02%3A00&*/
		
		/*PBX_HMAC=E152B285CF09A90ED3E05539189B467EB5EE442990E06638D2F0529794850B3F602260F16B6AECA4C51CCA8396F6974C8574363969AD92198EADA5C0BE598FD1*/

		$paybox = array(
			/*
			<input type="hidden" name="PBX_SITE" value="<?php echo $pbx_site; ?>">
			<input type="hidden" name="PBX_RANG" value="<?php echo $pbx_rang; ?>">
			<input type="hidden" name="PBX_IDENTIFIANT" value="<?php echo $pbx_identifiant; ?>">
			<input type="hidden" name="PBX_TOTAL" value="<?php echo $pbx_total; ?>">
			<input type="hidden" name="PBX_DEVISE" value="978">
			<input type="hidden" name="PBX_CMD" value="<?php echo $pbx_cmd; ?>">
			<input type="hidden" name="PBX_PORTEUR" value="<?php echo $pbx_porteur; ?>">
			<input type="hidden" name="PBX_REPONDRE_A" value="<?php echo $pbx_repondre_a; ?>">
			<input type="hidden" name="PBX_RETOUR" value="<?php echo $pbx_retour; ?>">
			<input type="hidden" name="PBX_EFFECTUE" value="<?php echo $pbx_effectue; ?>">
			<input type="hidden" name="PBX_ANNULE" value="<?php echo $pbx_annule; ?>">
			<input type="hidden" name="PBX_REFUSE" value="<?php echo $pbx_refuse; ?>">
			<input type="hidden" name="PBX_HASH" value="SHA512">
			<input type="hidden" name="PBX_TIME" value="<?php echo $dateTime; ?>">
			<input type="hidden" name="PBX_HMAC" value="<?php echo $hmac; ?>">
			*/
		);
      	
		$params = http_build_query($paybox);
		return new RedirectResponse('https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi?' . $params);
    }
}