<?php

namespace SocialBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use SocialBundle\Entity\Region;
use Rscine\AppBundle\Form\RegionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Rest\RouteResource("Region")
 */
class RegionController extends FOSRestController
{

    /**
     * Récupère la liste des départements
     * GET api/regions
     * @Rest\View()
     *
     * @return [type] [description]
     */
    public function cgetAction()
    {
        $regions = $this->getDoctrine()->getManager()->getRepository('SocialBundle:Region')->findAll();
        return $regions;
    }

    /**
     * Récupère un départment
     * GET api/regions/{slug}
     * @Rest\View()
     * @ParamConverter("region", class="SocialBundle:Region")
     *
     * @return [type] [description]
     */
    public function getAction(Region $region)
    {
        return $region;
    }

    /**
     * Crée un département
     * POST api/regions
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postAction(Request $request)
    {
        $region = new Region();

        $createForm = $this->createCreateForm($region);

        $createForm->submit($request->get($createForm->getName()));

        if ($createForm->isValid() && $createForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($region);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($this->get('serializer')->toArray($region));
        }

        return new JsonResponse($this->get('serializer')->toArray($createForm->getErrors()), 400);
    }

    /**
     * Modifie un départment
     * PUT api/regions/{slug}
     * @Rest\View()
     * @ParamConverter("region", class="SocialBundle:Region")
     *
     * @param  Request    $request    [description]
     * @param  Region $region [description]
     * @return [type]                 [description]
     */
    public function putAction(Request $request, Region $region)
    {

        $editForm = $this->createEditForm($region);

        $editForm->submit($request->get($editForm->getName()));

        if ($editForm->isValid() && $editForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($region);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($this->get('serializer')->toArray($region), 200);

        }

        return new JsonResponse($this->get('serializer')->toArray($editForm->getErrors()));
    }

    /**
     * Supprime le département $region
     * DELETE api/regions/{slug}
     *
     * @param  Region $region [description]
     * @return [type]                 [description]
     */
    public function deleteAction(Region $region)
    {
        $this->getDoctrine()->getManager()->remove($region);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('Message' => 'Region deleted'), 200);
    }

    /**
     * Retourne les options possibles pour tous les utilisateurs
     * OPTIONS api/regions
     *
     * @return [type]       [description]
     */
    public function coptionsAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, DELETE, POST, PUT');

        return $response;
    }

    /**
     * Retourne les options possibles pour un département
     * OPTIONS api/regions
     * @ParamConverter("region", class="SocialBundle:Region")
     *
     * @return [type]       [description]
     */
    public function optionsAction(Region $region)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, DELETE, POST, PUT');

        return $response;
    }

    /**
     * Retourne le formulaire d'édition d'un départment
     *
     * @param  [type] $region [description]
     * @return [type]             [description]
     */
    protected function createEditForm($region)
    {
        $editForm = $this->createForm(new RegionType(), $region);

        return $editForm;
    }

    /**
     * Retourne le formulaire de création d'un départment
     *
     * @param  [type] $region [description]
     * @return [type]             [description]
     */
    protected function createCreateForm($region)
    {
        $createForm = $this->createForm(new RegionType(), $region);

        return $createForm;
    }

}
