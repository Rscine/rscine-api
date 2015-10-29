<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class DepartmentController extends FOSRestController
{

    /**
     * Récupère la liste des départements
     * GET api/departments
     * @Rest\View()
     *
     * @return [type] [description]
     */
    public function getDepartmentsAction()
    {
        $departments = $this->getDoctrine()->getManager()->getRepository('AppBundle:Department')->findAll();
        return $departments;
    }

}
