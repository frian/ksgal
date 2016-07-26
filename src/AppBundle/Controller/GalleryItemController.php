<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

        // get galleryItem id
        $itemId = $galleryItem->getId();

        $em = $this->getDoctrine()->getManager();

        // get the gallery
        $gal = $em->getRepository('AppBundle:Gallery')->findOneByName($gallery);

    	// get galleryItems in gallery
    	$items = $em->getRepository('AppBundle:GalleryItem')->findByGallery($gal);


        $offset = $itemId-1;

        if ( !isset($items[$offset]) ) {
            throw new NotFoundHttpException("Page not found");
        }

        // get previous id
        $previous = '';
        if ( isset($items[$offset-1]) ) {
            $previous = $itemId-1;
        }

        // get next id
        $next = '';
        if ( isset($items[$offset+1]) ) {
            $next = $itemId+1;
        }

        return $this->render('galleryitem/show.html.twig', array(
            'galleryItem' => $items[$offset],
            'previous' => $previous,
            'next' => $next
        ));
    }
}
