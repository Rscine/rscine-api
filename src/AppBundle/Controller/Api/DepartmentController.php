<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Department;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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

    /**
     * Récupère un départment
     * GET api/departments/{slug}
     * @Rest\View()
     * @ParamConverter("department", class="AppBundle:Department")
     *
     * @return [type] [description]
     */
    public function getDepartmentAction(Department $department)
    {
        return $department;
    }

}
