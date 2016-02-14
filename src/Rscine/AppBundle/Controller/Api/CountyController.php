<?php

namespace Rscine\AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class CountyController extends FOSRestController
{

    /**
     * Récupère la liste des régions
     * GET api/counties
     * @Rest\View()
     *
     * @return [type] [description]
     */
    public function getCountiesAction()
    {
        $counties = $this->getDoctrine()->getManager()->getRepository('RscineAppBundle:County')->findAll();
        return $counties;
    }

}
