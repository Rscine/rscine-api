<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Department;
use AppBundle\Form\DepartmentType;
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

    /**
     * Crée un département
     * POST api/departments
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postDepartmentAction(Request $request)
    {
        $department = new Department();

        $createForm = $this->createCreateForm($department);

        $createForm->submit($request->get($createForm->getName()));

        if ($createForm->isValid() && $createForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($department);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($this->get('serializer')->toArray($department));
        }

        return new JsonResponse($this->get('serializer')->toArray($createForm->getErrors()), 400);
    }

    /**
     * Modifie un départment
     * PUT api/departments/{slug}
     * @Rest\View()
     * @ParamConverter("department", class="AppBundle:Department")
     *
     * @param  Request    $request    [description]
     * @param  Department $department [description]
     * @return [type]                 [description]
     */
    public function putDepartmentAction(Request $request, Department $department)
    {

        $editForm = $this->createEditForm($department);

        $editForm->submit($request->get($editForm->getName()));

        if ($editForm->isValid() && $editForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($department);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($this->get('serializer')->toArray($department), 200);

        }

        return new JsonResponse($this->get('serializer')->toArray($editForm->getErrors()));
    }

    /**
     * Supprime le département $department
     * DELETE api/departments/{slug}
     * 
     * @param  Department $department [description]
     * @return [type]                 [description]
     */
    public function deleteDepartmentAction(Department $department)
    {
        $this->getDoctrine()->getManager()->remove($department);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('Message' => 'Department deleted'), 200);
    }

    /**
     * Retourne les options possibles pour tous les utilisateurs
     * OPTIONS api/departments
     *
     * @return [type]       [description]
     */
    public function optionsDepartmentsAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, DELETE, POST, PUT');

        return $response;
    }

    /**
     * Retourne les options possibles pour un département
     * OPTIONS api/departments
     * @ParamConverter("department", class="AppBundle:Department")
     *
     * @return [type]       [description]
     */
    public function optionsDepartmentAction(Department $department)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, DELETE, POST, PUT');

        return $response;
    }

    /**
     * Retourne le formulaire d'édition d'un départment
     *
     * @param  [type] $department [description]
     * @return [type]             [description]
     */
    protected function createEditForm($department)
    {
        $editForm = $this->createForm(new DepartmentType(), $department);

        return $editForm;
    }

    /**
     * Retourne le formulaire de création d'un départment
     * 
     * @param  [type] $department [description]
     * @return [type]             [description]
     */
    protected function createCreateForm($department)
    {
        $createForm = $this->createForm(new DepartmentType(), $department);

        return $createForm;
    }

}
