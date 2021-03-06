<?php

namespace AppBundle\Controller\Admin;

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
 * @Route("/admin/galleryitem")
 */
class GalleryItemController extends Controller
{
    /**
     * Lists all GalleryItem entities.
     *
     * @Route("/", name="galleryitem_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $galleryItems = $em->getRepository('AppBundle:GalleryItem')->findAll();

        return $this->render('galleryitem/index.html.twig', array(
            'galleryItems' => $galleryItems,
        ));
    }

    /**
     * Creates a new GalleryItem entity.
     *
     * @Route("/new", name="galleryitem_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $galleryItem = new GalleryItem();
        $form = $this->createForm('AppBundle\Form\GalleryItemType', $galleryItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


        	$pathToGallery = $this->container->getParameter('images_directory').'/'.$galleryItem->getGallery();

        	// get main image
        	$image = $galleryItem->getImage();

        	// Move and rename
        	$image->move(
        		$pathToGallery,
        		$image->getClientOriginalName()
        	);

        	// set image name
        	$galleryItem->setImage($image->getClientOriginalName());



        	// get main image
        	$bgImage = $galleryItem->getBgimage();

        	// Move and rename
        	$bgImage->move(
        			$pathToGallery,
        			$bgImage->getClientOriginalName()
        			);

        	// set image name
        	$galleryItem->setBgimage($bgImage->getClientOriginalName());


            $em = $this->getDoctrine()->getManager();
            $em->persist($galleryItem);
            $em->flush();

            return $this->redirectToRoute('gallery_admin_show_content',
            	array(
            		'name' => $galleryItem->getGallery(),
            	));
        }

        return $this->render('admin/galleryitem/new.html.twig', array(
            'galleryItem' => $galleryItem,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GalleryItem entity.
     *
     * @Route("/{id}/edit", name="galleryitem_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GalleryItem $galleryItem)
    {
        $deleteForm = $this->createDeleteForm($galleryItem);

		// save current images ( needed if the images do not change )
        $currentImage = $galleryItem->getImage();
        $currentBgimage = $galleryItem->getBgimage();

        $editForm = $this->createForm('AppBundle\Form\GalleryItemType', $galleryItem);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

        	$pathToGallery = $this->container->getParameter('images_directory').'/'.$galleryItem->getGallery();

			// if images has not changed set old image
       		if ( $galleryItem->getImage() == null ) {
        		$galleryItem->setImage($currentImage);
        	}
        	else {
        		// get main image
        		$image = $galleryItem->getImage();

        		// Move and rename
        		$image->move(
        				$pathToGallery,
        				$image->getClientOriginalName()
        				);

        		// set image name
        		$galleryItem->setImage($image->getClientOriginalName());
        	}

        	if ( $galleryItem->getBgimage() == null ) {
        		$galleryItem->setBgimage($currentBgimage);
        	}
        	else {
        		// get main image
        		$bgImage = $galleryItem->getBgimage();

        		// Move and rename
        		$bgImage->move(
        				$pathToGallery,
        				$bgImage->getClientOriginalName()
        				);

        		// set image name
        		$galleryItem->setBgimage($bgImage->getClientOriginalName());
        	}


        	// persist
            $em = $this->getDoctrine()->getManager();
            $em->persist($galleryItem);
            $em->flush();

            return $this->redirectToRoute('gallery_admin_show_content', array('name' => $galleryItem->getGallery()));
        }

        return $this->render('admin/galleryitem/edit.html.twig', array(
            'galleryItem' => $galleryItem,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a GalleryItem entity.
     *
     * @Route("/{id}", name="galleryitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GalleryItem $galleryItem)
    {
        $form = $this->createDeleteForm($galleryItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($galleryItem);
            $em->flush();
        }

        return $this->redirectToRoute('galleryitem_index');
    }

    /**
     * Creates a form to delete a GalleryItem entity.
     *
     * @param GalleryItem $galleryItem The GalleryItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GalleryItem $galleryItem)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('galleryitem_delete', array('id' => $galleryItem->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
