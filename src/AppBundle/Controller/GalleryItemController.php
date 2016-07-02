<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\GalleryItem;
use AppBundle\Form\GalleryItemType;

/**
 * GalleryItem controller.
 *
 * @Route("/galleryitem")
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
        	
        	// get path to gallery
        	$pathToGallery = $this->container->getParameter('brochures_directory').'/'.$galleryItem->getGallery();
        	
        	// create gallery if not existing
        	if (!file_exists($pathToGallery)) {
        		mkdir($pathToGallery, 0755, true);
        	}

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

            return $this->redirectToRoute('galleryitem_show', array('id' => $galleryItem->getId()));
        }

        return $this->render('galleryitem/new.html.twig', array(
            'galleryItem' => $galleryItem,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a GalleryItem entity.
     *
     * @Route("/{id}", name="galleryitem_show")
     * @Method("GET")
     */
    public function showAction(GalleryItem $galleryItem)
    {
        $deleteForm = $this->createDeleteForm($galleryItem);

        return $this->render('galleryitem/show.html.twig', array(
            'galleryItem' => $galleryItem,
            'delete_form' => $deleteForm->createView(),
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
        $editForm = $this->createForm('AppBundle\Form\GalleryItemType', $galleryItem);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($galleryItem);
            $em->flush();

            return $this->redirectToRoute('galleryitem_edit', array('id' => $galleryItem->getId()));
        }

        return $this->render('galleryitem/edit.html.twig', array(
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
