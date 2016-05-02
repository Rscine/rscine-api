<?php

namespace Rscine\OAuthServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RscineOAuthServerBundle:Default:index.html.twig', array('name' => $name));
    }
}
