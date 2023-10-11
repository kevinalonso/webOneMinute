<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

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

            foreach ($announcements as $value) {
                
                $path = str_replace("/home/minutee/www","",$value->getImage());
                $value->setImage($path);
            }

            $catName = $announcements[0];

            $cat = $this->getDoctrine()->getRepository(Category::class)
            ->getCategory($id);

            return $this->render('category.html.twig', [
                'announcements' => $announcements,
                'titleCat' => $catName,
                'cat'=>$cat[0]->getId()
            ]);

        } else {
            return $this->render('category.html.twig', [
                'announcements' => $announcements,
                'titleCat' => 'Aucunes annonces pour cette catégorie'
            ]);
        }
        
      
    	return $this->render('category.html.twig', [
            'announcements' => $announcements,
            'titleCat' => $catName
        ]);
    }

    public function search(int $idCat, Request $request): JsonResponse
    {
        
        $txtSearch = $request->request->get('search');

        $announcements = $this->getDoctrine()->getRepository(Announcement::class)
            ->searchInCategory($idCat,$txtSearch,$txtSearch,$txtSearch);
            
        foreach ($announcements as $value) {
                
            $path = str_replace("/home/minutee/www","",$value->getImage());
            $value->setImage($path);
        }

        return new JsonResponse(array(
            'status' => 'OK',
            'html' => $this->renderView('category.html.twig', [
                'announcements' => $announcements,
                'titleCat' => $announcements[0],
                'cat' => $idCat
                ])
        ),
        200);
        
        /*return  = $this->render('category.html.twig', [
            'announcements' => $announcements,
            'titleCat' => $announcements[0],
            'cat' => $idCat
        ]);*/
    }
}