<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Announcement;
use Symfony\Component\HttpFoundation\JsonResponse;

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

   /** 
   * @Route("/createannouncement") 
   */ 
    public function create(Request $request,UserInterface $user) :Response
    {
    	$announcement = new Announcement();

       
    	$announcement->setTitle($request->request->get('title'));
    	$announcement->setDescription($request->request->get('description'));
    	$announcement->setUser($user);
    	$announcement->setPrice($request->request->get('price'));
    	$announcement->setImage("");
    	$announcement->setDatePublish(new \DateTime('now'));
    	$announcement->setIsActive(true);

    	$this->getDoctrine()->getRepository(Announcement::class)
            ->insert($announcement,$request->request->get('category'));

    	return new JsonResponse(array(
            'status' => 'OK',
        ),
        200);
    	
    }
}