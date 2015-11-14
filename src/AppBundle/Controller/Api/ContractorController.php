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
use AppBundle\Entity\User;
use AppBundle\Model\ContractorInterface;
use AppBundle\Form\ContractorRegistrationType;
use AppBundle\Form\ContractorProfileType;

class ContractorController extends FOSRestController
{
    /**
     * Récupère un utilisateur client
     * GET api/contractors/{slug}
     * 
     * @Rest\View()
     * @ParamConverter("contractor", class="AppBundle:User")
     */
    public function getContractorAction(ContractorInterface $contractor)
    {
        return $contractor;
    }

    /**
     * Récupère tous les utilisateurs clients
     * GET api/contractors
     * 
     * @Rest\View()
     */
    public function getContractorsAction()
    {
        $contractors = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\User')->findAll();

        return $contractors;  
    }

    /**
     * Crée un utilisateur client
     * POST api/contractors
     */
    public function postContractorAction(Request $request)
    {
        $contractor = new User();

        $registrationForm = $this->createContractorRegistrationForm($contractor);

        $registrationForm->submit($request->get($registrationForm->getName()));

        if ($registrationForm->isValid() && $registrationForm->isSubmitted()) {
            
            $this->getDoctrine()->getManager()->persist($contractor);
            $this->getDoctrine()->getManager()->flush();

            return $contractor;
        }

        return new JsonResponse($this->get('serializer')->toArray($registrationForm), 400);
    }

    /**
     * Modifie un utilisateur client
     * PUT api/contractors/{slug}
     * 
     * @ParamConverter("contractor", class="AppBundle:User")
     */
    public function putContractorAction(Request $request, ContractorInterface $contractor)
    {
        $profileForm = $this->createContractorProfileForm($contractor);

        $profileForm->submit($request->get($profileForm->getName()));

        if ($profileForm->isValid() && $profileForm->isSubmitted()) {

              $this->getDoctrine()->getManager()->persist($contractor);
              $this->getDoctrine()->getManager()->flush();

              return $contractor;
        }

        return new JsonResponse($this->get('serializer')->toArray($profileForm->getErrors()));
    }

    /**
     * Récupère les options possibles pour un utilisateur client
     * OPTIONS api/contractors/{slug}
     *
     * @ParamConverter("contractor", class="AppBundle:User")
     */
    public function optionsContractorAction(ContractorInterface $contractor)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');

        return $response;
    }

    /**
     * Récupère les options possibles pour tous les utilisateurs clients
     * OPTIONS api/contractors
     */
    public function optionsContractorsAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');

        return $response;
    }

    /**
     * Supprime un utilisateur client $contractor
     * DELETE api/contractors/{slug}
     * 
     * @ParamConverter("contractor", class="AppBundle:User")
     */
    public function deleteContractorAction(ContractorInterface $contractor)
    {
        $this->getDoctrine()->getManager()->remove($contractor);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('Message' => 'Contractor deleted'), 200);
    }

    /**
     * Retourne le formulaire de création d'un utilisateur client
     * 
     * @param  Contractor $contractor [description]
     * @return [type]             [description]
     */
    private function createContractorRegistrationForm(ContractorInterface $contractor)
    {
        $contractorRegistrationType = $this->createForm(new ContractorRegistrationType(), $contractor);

        return $contractorRegistrationType;
    }

    /**
     * Retourne le forumaire d'édition de profil d'un utilisateur client
     * 
     * @param  Contractor $contractor [description]
     * @return [type]             [description]
     */
    private function createContractorProfileForm(ContractorInterface $contractor)
    {
        $contractorProfileForm = $this->createForm(new ContractorProfileType(), $contractor);

        return $contractorProfileForm;
    }
}
