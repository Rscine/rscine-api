<?php

namespace Rscine\AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class RegionController extends FOSRestController
{

    /**
     * Récupère la liste des régions
     * GET api/regions
     * @Rest\View()
     *
     * @return [type] [description]
     */
    public function getCountiesAction()
    {
        $regions = $this->getDoctrine()->getManager()->getRepository('RscineAppBundle:Region')->findAll();
        return $regions;
    }

}
