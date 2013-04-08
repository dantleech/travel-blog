<?php

namespace DTL\TravelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DTLTravelBundle:Default:index.html.twig', array('name' => $name));
    }
}
