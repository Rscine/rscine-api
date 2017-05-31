<?php

namespace SocialBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use SocialBundle\Entity\District;
use Rscine\AppBundle\Form\DistrictType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DistrictController extends FOSRestController
{

    /**
     * Récupère la liste des départements
     * GET api/districts
     * @Rest\View()
     *
     * @return [type] [description]
     */
    public function getDistrictsAction()
    {
        $districts = $this->getDoctrine()->getManager()->getRepository('RscineWorkerBundle:District')->findAll();
        return $districts;
    }

    /**
     * Récupère un départment
     * GET api/districts/{slug}
     * @Rest\View()
     * @ParamConverter("district", class="RscineWorkerBundle:District")
     *
     * @return [type] [description]
     */
    public function getDistrictAction(District $district)
    {
        return $district;
    }

    /**
     * Crée un département
     * POST api/districts
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postDistrictAction(Request $request)
    {
        $district = new District();

        $createForm = $this->createCreateForm($district);

        $createForm->submit($request->get($createForm->getName()));

        if ($createForm->isValid() && $createForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($district);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($this->get('serializer')->toArray($district));
        }

        return new JsonResponse($this->get('serializer')->toArray($createForm->getErrors()), 400);
    }

    /**
     * Modifie un départment
     * PUT api/districts/{slug}
     * @Rest\View()
     * @ParamConverter("district", class="RscineWorkerBundle:District")
     *
     * @param  Request    $request    [description]
     * @param  District $district [description]
     * @return [type]                 [description]
     */
    public function putDistrictAction(Request $request, District $district)
    {

        $editForm = $this->createEditForm($district);

        $editForm->submit($request->get($editForm->getName()));

        if ($editForm->isValid() && $editForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($district);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($this->get('serializer')->toArray($district), 200);

        }

        return new JsonResponse($this->get('serializer')->toArray($editForm->getErrors()));
    }

    /**
     * Supprime le département $district
     * DELETE api/districts/{slug}
     *
     * @param  District $district [description]
     * @return [type]                 [description]
     */
    public function deleteDistrictAction(District $district)
    {
        $this->getDoctrine()->getManager()->remove($district);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('Message' => 'District deleted'), 200);
    }

    /**
     * Retourne les options possibles pour tous les utilisateurs
     * OPTIONS api/districts
     *
     * @return [type]       [description]
     */
    public function optionsDistrictsAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, DELETE, POST, PUT');

        return $response;
    }

    /**
     * Retourne les options possibles pour un département
     * OPTIONS api/districts
     * @ParamConverter("district", class="RscineWorkerBundle:District")
     *
     * @return [type]       [description]
     */
    public function optionsDistrictAction(District $district)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, DELETE, POST, PUT');

        return $response;
    }

    /**
     * Retourne le formulaire d'édition d'un départment
     *
     * @param  [type] $district [description]
     * @return [type]             [description]
     */
    protected function createEditForm($district)
    {
        $editForm = $this->createForm(new DistrictType(), $district);

        return $editForm;
    }

    /**
     * Retourne le formulaire de création d'un départment
     *
     * @param  [type] $district [description]
     * @return [type]             [description]
     */
    protected function createCreateForm($district)
    {
        $createForm = $this->createForm(new DistrictType(), $district);

        return $createForm;
    }

}
