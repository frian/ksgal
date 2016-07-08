<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Gallery;
use AppBundle\Form\GalleryType;

/**
 * Gallery controller.
 *
 * @Route("/gallery")
 */
class GalleryController extends Controller
{
    /**
     * Lists all Gallery entities.
     *
     * @Route("/", name="gallery_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $galleries = $em->getRepository('AppBundle:Gallery')->findAll();

        return $this->render('gallery/index.html.twig', array(
            'galleries' => $galleries,
        ));
    }


    /**
     * Finds and displays a Gallery content.
     *
     * @Route("/show/{name}", name="gallery_show_content")
     * @Method("GET")
     */
    public function showGalleryAction($name)
    {
    
    	$gallery = $this->getDoctrine()
	    	->getRepository('AppBundle:Gallery')
	    	->findOneByName($name);
    	
	   	$galleryItems = $gallery->getGalleryItems();
	    	
    	return $this->render('gallery/showContent.html.twig', array(
    		'name' => $name,
    		'galleryItems' => $galleryItems
    	));
    }

}
