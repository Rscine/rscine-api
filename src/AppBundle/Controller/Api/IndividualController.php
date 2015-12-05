<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Individual;
use AppBundle\Form\RegistrationType as IndividualRegistrationType;
use AppBundle\Form\ProfileType as IndividualProfileType;

class IndividualController extends FOSRestController
{
    /**
     * Récupère un utilisateur client
     * GET api/individuals/{slug}
     * 
     * @Rest\View()
     * @ParamConverter("individual", class="AppBundle:Individual")
     */
    public function getIndividualAction(Individual $individual)
    {
        return $individual;
    }

    /**
     * Récupère tous les utilisateurs clients
     * GET api/individuals
     * 
     * @Rest\View()
     */
    public function getIndividualsAction()
    {
        $individuals = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Individual')->findAll();

        return $individuals;  
    }

    /**
     * Crée un utilisateur client
     * POST api/individuals
     */
    public function postIndividualAction(Request $request)
    {
        $individual = new Individual();

        $registrationForm = $this->createIndividualRegistrationForm($individual);

        $registrationForm->submit($request->get($registrationForm->getName()));

        if ($registrationForm->isValid() && $registrationForm->isSubmitted()) {
            
            $this->getDoctrine()->getManager()->persist($individual);
            $this->getDoctrine()->getManager()->flush();

            return $individual;
        }

        return new JsonResponse($this->get('serializer')->toArray($registrationForm), 400);
    }

    /**
     * Modifie un utilisateur client
     * PUT api/individuals/{slug}
     * 
     * @ParamConverter("individual", class="AppBundle:Individual")
     */
    public function putIndividualAction(Request $request, Individual $individual)
    {
        $profileForm = $this->createIndividualProfileForm($individual);

        $profileForm->submit($request->get($profileForm->getName()));

        if ($profileForm->isValid() && $profileForm->isSubmitted()) {

              $this->getDoctrine()->getManager()->persist($individual);
              $this->getDoctrine()->getManager()->flush();

              return $individual;
        }

        return new JsonResponse($this->get('serializer')->toArray($profileForm->getErrors()));
    }

    /**
     * Récupère les options possibles pour un utilisateur client
     * OPTIONS api/individuals/{slug}
     *
     * @ParamConverter("individual", class="AppBundle:Individual")
     */
    public function optionsIndividualAction(Individual $individual)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');

        return $response;
    }

    /**
     * Récupère les options possibles pour tous les utilisateurs clients
     * OPTIONS api/individuals
     */
    public function optionsIndividualsAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');

        return $response;
    }

    /**
     * Supprime un utilisateur client $individual
     * DELETE api/individuals/{slug}
     * 
     * @ParamConverter("individual", class="AppBundle:Individual")
     */
    public function deleteIndividualAction(Individual $individual)
    {
        $this->getDoctrine()->getManager()->remove($individual);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('Message' => 'Individual deleted'), 200);
    }

    /**
     * Retourne le formulaire de création d'un utilisateur client
     * 
     * @param  Individual $individual [description]
     * @return [type]             [description]
     */
    private function createIndividualRegistrationForm(Individual $individual)
    {
        $individualRegistrationType = $this->createForm(new IndividualRegistrationType(), $individual);

        return $individualRegistrationType;
    }

    /**
     * Retourne le forumaire d'édition de profil d'un utilisateur client
     * 
     * @param  Individual $individual [description]
     * @return [type]             [description]
     */
    private function createIndividualProfileForm(Individual $individual)
    {
        $individualProfileForm = $this->createForm(new IndividualProfileType(), $individual);

        return $individualProfileForm;
    }
}
