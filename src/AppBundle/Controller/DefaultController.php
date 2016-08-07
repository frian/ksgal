<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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

    /**
     * contact
     *
     * @Route("/contact", name="contact")
     */
     public function contactAction(Request $request) {
         // Create the form according to the FormType created previously.
         // And give the proper parameters
         $form = $this->createForm('AppBundle\Form\ContactType',null,array(
             // To set the action use $this->generateUrl('route_identifier')
             'action' => $this->generateUrl('contact'),
             'method' => 'POST'
         ));

         if ($request->isMethod('POST')) {
             // Refill the fields in case the form is not valid.
             $form->handleRequest($request);

             if ($form->isValid()) {

                 $data = $form->getData();

                 $message = \Swift_Message::newInstance()
                    ->setSubject('Contact from ' . $data['name'])
                    ->setFrom('k@kasgal.com')
                    ->setTo('andre@at-info.ch')
                    ->setBody($data["message"]);

                    $this->get('mailer')->send($message);

                    return $this->redirectToRoute('gallery_index');
             }
         }

         return $this->render('default/contact.html.twig', array(
             'form' => $form->createView()
         ));
     }
}
