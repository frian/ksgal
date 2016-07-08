<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function indexAction(Request $request)
    {
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	$galleries = $em->getRepository('AppBundle:Gallery')->findAll();
    	
    	
    	
        return $this->render('admin/default/index.html.twig', array(
            'galleries' => $galleries,
        ));
    }
}
