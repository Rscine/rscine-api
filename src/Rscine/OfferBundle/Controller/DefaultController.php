<?php

namespace Rscine\OfferBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RscineOfferBundle:Default:index.html.twig', array('name' => $name));
    }
}
