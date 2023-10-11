<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Offer;
use App\Entity\ImageCategory;
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
            $endDate = clone $offer[1]->getDateofSale();
            if ($offer[0]->getMonth()) {
                $endDate = $endDate->modify('+1 month');
            }

            if ($offer[0]->getYear()) {
                $endDate = $endDate->modify('+1 year');
            }

            if (new \DateTime() < $endDate){
                $hasOffer = true;
            }
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
        $announcement->setCity($request->request->get('city'));
    	$announcement->setDescription($request->request->get('description'));
    	$announcement->setUser($user);
    	$announcement->setPrice($request->request->get('price'));


        //Get image from category selected
        $imageCat = $this->getDoctrine()->getRepository(ImageCategory::class)
            ->getImageFromCategory($request->request->get('category'));

    	$announcement->setImage($imageCat[0]->getPath());

    	$announcement->setDatePublish(new \DateTime('now'));
    	$announcement->setIsActive(true);

        //$announcement->setImage1(file_get_contents($request->get('img1')));
        $announcement->setImage1($request->request->get('img1'));
        $announcement->setImage2($request->request->get('img2'));
        $announcement->setImage3($request->request->get('img3'));
        $announcement->setImage4($request->request->get('img4'));
        $announcement->setImage5($request->request->get('img5'));
        $announcement->setImage6($request->request->get('img6'));
        $announcement->setImage7($request->request->get('img7'));
        $announcement->setImage8($request->request->get('img8'));
        $announcement->setImage9($request->request->get('img9'));
        

    	$this->getDoctrine()->getRepository(Announcement::class)
            ->insert($announcement,$request->request->get('category'));

    	return new JsonResponse(array(
            'status' => 'OK',
        ),
        200);
    }

    public function editAnnoucementView(int $id,UserInterface $user): Response
    {

        $announcement = $this->getDoctrine()->getRepository(Announcement::class)
            ->getAnnouncementById($id);

        $categories = $this->getDoctrine()->getRepository(Category::class)
            ->allCategories();

        //Check if user has subcribe to offer
        $offer = $this->getDoctrine()->getRepository(Offer::class)
            ->getOfferBuy($user->getId());

        $hasOffer = false;
        if (!empty($offer)) {
            $endDate = clone $offer[1]->getDateofSale();
            if ($offer[0]->getMonth()) {
                $endDate = $endDate->modify('+1 month');
            }

            if ($offer[0]->getYear()) {
                $endDate = $endDate->modify('+1 year');
            }

            if (new \DateTime() < $endDate){
                $hasOffer = true;
            }
        }
      
        return $this->render('editformannouncement.html.twig', [
            'announcement' => $announcement,
            'categories'=>$categories,
            'hasOffer' => $hasOffer,
            'offer' => $offer
        ]);
    }

    public function editAnnouncement(Request $request, UserInterface $user): Response
    {
        $updateAnnouncement = new Announcement();
        $cat = new Category();

        $updateAnnouncement->setId($request->request->get('id'));
        $updateAnnouncement->setTitle($request->request->get('title'));
        $updateAnnouncement->setCity($request->request->get('city'));
        $updateAnnouncement->setDescription($request->request->get('desc'));
        $updateAnnouncement->setPrice($request->request->get('price'));
        $updateAnnouncement->setDatePublish(new \DateTime('now'));
        $updateAnnouncement->setIsActive(true);
        
        //Get image from category selected
        $imageCat = $this->getDoctrine()->getRepository(ImageCategory::class)
            ->getImageFromCategory($request->request->get('category'));

        $updateAnnouncement->setImage($imageCat[0]->getPath());

        $updateAnnouncement->setImage1($request->request->get('img1'));
        $updateAnnouncement->setImage2($request->request->get('img2'));
        $updateAnnouncement->setImage3($request->request->get('img3'));
        $updateAnnouncement->setImage4($request->request->get('img4'));
        $updateAnnouncement->setImage5($request->request->get('img5'));
        $updateAnnouncement->setImage6($request->request->get('img6'));
        $updateAnnouncement->setImage7($request->request->get('img7'));
        $updateAnnouncement->setImage8($request->request->get('img8'));
        $updateAnnouncement->setImage9($request->request->get('img9'));

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