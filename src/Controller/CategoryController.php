<?php

namespace App\Controller;

use App\Entity\Announcement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
	/**
	* @Route("/category/{id}")
	*/
	public function category(int $id): Response
    {

    	$announcements = $this->getDoctrine()->getRepository(Announcement::class)
            ->getAnnoucementFromCategory($id);

        if ($announcements != null) {

            $catName = $announcements[0];

            return $this->render('category.html.twig', [
                'announcements' => $announcements,
                'titleCat' => $catName
            ]);

        } else {
            return $this->render('category.html.twig', [
                'announcements' => $announcements,
                'titleCat' => 'Aucune annonce pour cette catégorie'
            ]);
        }
        
      
    	return $this->render('category.html.twig', [
            'announcements' => $announcements,
            'titleCat' => $catName
        ]);
    }
}