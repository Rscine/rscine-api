<?php

namespace Rscine\WorkerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RscineWorkerBundle:Default:index.html.twig', array('name' => $name));
    }
}
