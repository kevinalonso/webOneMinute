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

        $subMenu = [];
        foreach ($categories as $item) {
            if ($item->getCategory() != null) {
                array_push($subMenu,$item);
            }
        }

        $final = [];
        foreach ($categories as $item) {
            foreach ($subMenu as $l) {
                if ($item->getId() == $l->getCategory()->getId()) {
                    $item->setCategories($l);
                }
            }
            array_push($final, $item);
        }

        $categories = $final;

        $announcements = $this->getDoctrine()->getRepository(Announcement::class)
            ->getTop10Annoucement();

        foreach ($announcements as $value) {
                
            $path = str_replace("/home/minutee/www","",$value->getImage());
            $value->setImage($path);
        }

        return $this->render('index.html.twig', [
            'categories' => $categories,
            'announcements'=>$announcements
        ]);
    }

}