<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Announcement;

class AnnouncementController extends AbstractController
{
	/**
    * @Route("/account/create/announcement")
    */
    public function createView(): Response
    {

    	$categories = $this->getDoctrine()->getRepository(Category::class)
            ->allCategories();

        return $this->render('createformannouncement.html.twig', [
        	'categories'=>$categories
        ]);
    }
}