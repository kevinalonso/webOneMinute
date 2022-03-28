<?php

namespace App\Controller;

use App\Entity\Announcement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DetailAnnouncementController extends AbstractController
{
	/**
	* @Route("/announcement/{id}")
	*/
	public function announcement(int $id): Response
    {

        $announcement = $this->getDoctrine()->getRepository(Announcement::class)
            ->getAnnouncementById($id);

      
        $path = str_replace("/home/minutee/www","",$announcement[0]->getImage());

        $announcement[0]->setImage($path);
      
    	return $this->render('detail.html.twig', [
            'announcement' => $announcement,
            'path' => $path
        ]);
    }
}