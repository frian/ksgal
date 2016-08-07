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
    public function indexAction(Request $request) {

    	$em = $this->getDoctrine()->getManager();

    	// get the gallery
    	$galleryItems = $em->getRepository('AppBundle:GalleryItem')->findAll();

        /*
        *  get random image
        */
    	$numItems = count($galleryItems);

    	$currentItemOffset = rand(0, $numItems-1);

    	$currentItem = null;

    	if ( isset($galleryItems[$currentItemOffset]) ) {
    		$currentItem = $galleryItems[$currentItemOffset];
    	}

        return $this->render('default/index.html.twig', array( 'galleryItem' => $currentItem ));
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction(Request $request) {
        return $this->render('default/about.html.twig');
    }
}
