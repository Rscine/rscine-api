<?php

namespace OfferBundle\Controller\Api;

use OfferBundle\Entity\Offer;
use Rscine\AppBundle\Form\OfferType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OfferController extends FOSRestController
{

    /**
     * Récupère la liste des départements
     * GET api/offers
     * @Rest\View()
     * @Rest\QueryParam(name="sort", requirements="(created|id|name)", default="created", description="search according to date, id or name")
     * @Rest\QueryParam(name="dir", requirements="(asc|desc)", default="desc", description="sort search ascending or descending")
     *
     * @return [type] [description]
     */
    public function getOffersAction(ParamFetcher $paramFetcher)
    {
        $sortBy = $paramFetcher->get('sort');
        $sortDir = $paramFetcher->get('dir');

        $offers = $this->getDoctrine()->getManager()->getRepository('OfferBundle:Offer')->findBy(array(), array($sortBy => $sortDir));
        return $offers;
    }

    /**
     * Récupère un départment
     * GET api/offers/{slug}
     * @Rest\View()
     * @ParamConverter("offer", class="OfferBundle:Offer")
     *
     * @return [type] [description]
     */
    public function getOfferAction(Offer $offer)
    {
        return $offer;
    }

    /**
     * Crée un département
     * POST api/offers
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postOfferAction(Request $request)
    {
        $offer = new Offer();

        $createForm = $this->createCreateForm($offer);

        $createForm->submit($request->get($createForm->getName()));

        if ($createForm->isValid() && $createForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($offer);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($this->get('serializer')->toArray($offer));
        }

        return new JsonResponse($this->get('serializer')->toArray($createForm->getErrors()), 400);
    }

    /**
     * Modifie un départment
     * PUT api/offers/{slug}
     * @Rest\View()
     * @ParamConverter("offer", class="OfferBundle:Offer")
     *
     * @param  Request    $request    [description]
     * @param  Offer $offer [description]
     * @return [type]                 [description]
     */
    public function putOfferAction(Request $request, Offer $offer)
    {

        $editForm = $this->createEditForm($offer);

        $editForm->submit($request->get($editForm->getName()));

        if ($editForm->isValid() && $editForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($offer);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($this->get('serializer')->toArray($offer), 200);

        }

        return new JsonResponse($this->get('serializer')->toArray($editForm->getErrors()));
    }

    /**
     * Supprime le département $offer
     * DELETE api/offers/{slug}
     *
     * @param  Offer $offer [description]
     * @return [type]                 [description]
     */
    public function deleteOfferAction(Offer $offer)
    {
        $this->getDoctrine()->getManager()->remove($offer);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('Message' => 'Offer deleted'), 200);
    }

    /**
     * Retourne les options possibles pour tous les utilisateurs
     * OPTIONS api/offers
     *
     * @return [type]       [description]
     */
    public function optionsOffersAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, DELETE, POST, PUT');

        return $response;
    }

    /**
     * Retourne les options possibles pour un département
     * OPTIONS api/offers
     * @ParamConverter("offer", class="OfferBundle:Offer")
     *
     * @return [type]       [description]
     */
    public function optionsOfferAction(Offer $offer)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, DELETE, POST, PUT');

        return $response;
    }

    /**
     * Retourne le formulaire d'édition d'un départment
     *
     * @param  [type] $offer [description]
     * @return [type]             [description]
     */
    protected function createEditForm($offer)
    {
        $editForm = $this->createForm(new OfferType(), $offer);

        return $editForm;
    }

    /**
     * Retourne le formulaire de création d'un départment
     *
     * @param  [type] $offer [description]
     * @return [type]             [description]
     */
    protected function createCreateForm($offer)
    {
        $createForm = $this->createForm(new OfferType(), $offer);

        return $createForm;
    }

}
