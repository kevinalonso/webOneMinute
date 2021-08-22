<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Offer;
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
    public function createView(UserInterface $user): Response
    {

    	$categories = $this->getDoctrine()->getRepository(Category::class)
            ->allCategories();

        //Check if user has subcribe to offer
        $offer = $this->getDoctrine()->getRepository(Offer::class)
            ->getOfferBuy($user->getId());

        $hasOffer = false;
        if (!empty($offer)) {
            $hasOffer = true;
        }

        return $this->render('createformannouncement.html.twig', [
        	'categories' => $categories,
            'hasOffer' => $hasOffer,
            'offer' => $offer
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

        $blob = fopen($request->get('img1'), 'r');

        //$announcement->setImage1(file_get_contents($request->get('img1')));
        $announcement->setImage1($blob);
        /*$announcement->setImage2();
        $announcement->setImage3();
        $announcement->setImage4();
        $announcement->setImage5();
        $announcement->setImage6();
        $announcement->setImage7();
        $announcement->setImage8();
        $announcement->setImage9();*/
        

    	$this->getDoctrine()->getRepository(Announcement::class)
            ->insert($announcement,$request->request->get('category'));

    	return new JsonResponse(array(
            'status' => 'OK',
        ),
        200);	
    }

    public function editAnnoucementView(int $id): Response
    {

        $announcement = $this->getDoctrine()->getRepository(Announcement::class)
            ->getAnnouncementById($id);

        $categories = $this->getDoctrine()->getRepository(Category::class)
            ->allCategories();

        $test = $this->getDoctrine()->getRepository(Category::class)
            ->getCategory("14");
      
        return $this->render('editformannouncement.html.twig', [
            'announcement' => $announcement,
            'categories'=>$categories,
            'test'=>$test
        ]);
    }

    public function editAnnouncement(Request $request, UserInterface $user): Response
    {
        $updateAnnouncement = new Announcement();
        $cat = new Category();

        $updateAnnouncement->setId($request->request->get('id'));
        $updateAnnouncement->setTitle($request->request->get('title'));
        $updateAnnouncement->setDescription($request->request->get('desc'));
        $updateAnnouncement->setPrice($request->request->get('price'));
        $updateAnnouncement->setDatePublish(new \DateTime('now'));
        $updateAnnouncement->setIsActive(true);
        $updateAnnouncement->setImage("");

        $dataCat = $this->getDoctrine()->getRepository(Category::class)
            ->getCategory($request->request->get('category'));

        $cat->setId($dataCat[0]->getId());
        $cat->setName($dataCat[0]->getName());
        $cat->setIsActive($dataCat[0]->getIsActive());

        $updateAnnouncement->setCategory($cat);
        $updateAnnouncement->setUser($user);

        $this->getDoctrine()->getRepository(Announcement::class)
            ->updateAnnouncement($updateAnnouncement);   

       
        return new JsonResponse(array(
            'status' => 'OK',
        ),
        200);
    }
}