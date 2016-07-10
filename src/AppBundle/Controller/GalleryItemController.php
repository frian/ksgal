<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\GalleryItem;
use AppBundle\Form\GalleryItemType;
use Symfony\Component\HttpFoundation\File\File;


/**
 * GalleryItem controller.
 *
 * @Route("/galleryitem")
 */
class GalleryItemController extends Controller
{
    /**
     * Finds and displays a GalleryItem entity.
     *
     * @Route("/{gallery}/{id}", name="galleryitem_show")
     * @Method("GET")
     */
    public function showAction($gallery, GalleryItem $galleryItem)
    {
        return $this->render('galleryitem/show.html.twig', array(
            'galleryItem' => $galleryItem,
        ));
    }


    /**
     * Finds and displays the next GalleryItem entity.
     *
     * @Route("/{gallery}/next/{id}", name="galleryitem_show_next")
     * @Method("GET")
     */
    public function showNextAction($gallery, GalleryItem $galleryItem)
    {
    	
    	// get galleryItem id
    	$itemId = $galleryItem->getId();
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	// get the gallery
    	$gal = $em->getRepository('AppBundle:Gallery')->findOneByName($gallery);

    	// get galleryItems in gallery
    	$items = $em->getRepository('AppBundle:GalleryItem')->findByGallery($gal);

    	
    	$next = 1;
    	foreach ( $items as $item ) {
    		
    		if ( $item->getId() == $itemId ) {
    			
				if ( isset($items[$next]) ) {
					$galleryItem = $items[$next];
				}
    		}
    		$next++;
    	}
    	
    	
    	return $this->render('galleryitem/show.html.twig', array(
    			'galleryItem' => $galleryItem,
    	));
    }


    /**
     * Finds and displays the previous GalleryItem entity.
     *
     * @Route("/{gallery}/prev/{id}", name="galleryitem_show_prev")
     * @Method("GET")
     */
    public function showPrevAction($gallery, GalleryItem $galleryItem)
    {
    	 
    	// get galleryItem id
    	$itemId = $galleryItem->getId();
    	 
    	$em = $this->getDoctrine()->getManager();
    	 
    	// get the gallery
    	$gal = $em->getRepository('AppBundle:Gallery')->findOneByName($gallery);
    	 
    	// get galleryItems in gallery
    	$items = $em->getRepository('AppBundle:GalleryItem')->findByGallery($gal);
    
		$items = array_reverse($items);    	 
    	 
    	$next = 1;
    	foreach ( $items as $item ) {
    
    		if ( $item->getId() == $itemId ) {
    			 
    			if ( isset($items[$next]) ) {
    				$galleryItem = $items[$next];
    			}
    		}
    		$next++;
    	}
    	 
    	 
    	return $this->render('galleryitem/show.html.twig', array(
    			'galleryItem' => $galleryItem,
    	));
    }
    
}
