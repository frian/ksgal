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
     * @Route("/{id}", name="galleryitem_show")
     * @Method("GET")
     */
    public function showAction(GalleryItem $galleryItem)
    {
//         $deleteForm = $this->createDeleteForm($galleryItem);

        return $this->render('galleryitem/show.html.twig', array(
            'galleryItem' => $galleryItem,
//             'delete_form' => $deleteForm->createView(),
        ));
    }

}
