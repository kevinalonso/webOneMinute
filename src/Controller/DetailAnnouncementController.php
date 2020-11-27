<?php

namespace App\Controller;

use App\Entity\Announcement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailAnnouncementController extends AbstractController
{
	/**
	* @Route("/announcement/{id}")
	*/
	public function announcement(int $id): Response
    {

        $announcement = $this->getDoctrine()->getRepository(Announcement::class)
            ->getAnnouncementById($id);
      
    	return $this->render('detail.html.twig', [
            'announcement' => $announcement
        ]);
    }
}