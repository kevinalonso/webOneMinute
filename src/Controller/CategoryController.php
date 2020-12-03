<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Entity\Category;
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

            $cat = $this->getDoctrine()->getRepository(Category::class)
            ->getCategory(2);

            return $this->render('category.html.twig', [
                'announcements' => $announcements,
                'titleCat' => $catName,
                'cat'=>$cat[0]->getId()
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