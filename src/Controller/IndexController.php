<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Announcement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
 
	/**
	* @Route("/")
	*/
	public function index(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)
            ->allCategories();

        $announcements = $this->getDoctrine()->getRepository(Announcement::class)
            ->getTop10Annoucement();

        return $this->render('index.html.twig', [
            'categories' => $categories,
            'announcements'=>$announcements
        ]);
    }

}