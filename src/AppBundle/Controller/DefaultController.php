<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

    	$em = $this->getDoctrine()->getManager();
    	 
    	// get the gallery
    	$galleryItems = $em->getRepository('AppBundle:GalleryItem')->findAll();
    	
    	$numItems = count($galleryItems);
    	
    	$currentItemOffset = rand(0, $numItems-1);
    	
    	$currentItem = null;
    	
    	if ( isset($galleryItems[$currentItemOffset]) ) {
    		$currentItem = $galleryItems[$currentItemOffset];
    	}
    	
    	
    	
        return $this->render('default/index.html.twig', array( 'galleryItem' => $currentItem ));
    }
}
