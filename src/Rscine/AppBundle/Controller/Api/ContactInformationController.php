<?php

namespace Rscine\AppBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Rscine\AppBundle\Entity\ContactInformation;
use Rscine\AppBundle\Form\ProfileType as ContactInformationProfileType;
use Rscine\AppBundle\Form\RegistrationType as ContactInformationRegistrationType;

/**
 * @Rest\RouteResource("ContactInformation")
 */
class ContactInformationController extends FOSRestController
{
    /**
     * Récupère un utilisateur client
     * GET api/contactInformations/{slug}
     *
     * @Rest\View()
     * @ParamConverter("contactInformation", class="RscineAppBundle:ContactInformation")
     */
    public function getAction(ContactInformation $contactInformation)
    {
        return $contactInformation;
    }

    /**
     * Récupère tous les utilisateurs clients
     * GET api/contactInformations
     *
     * @Rest\View()
     */
    public function cgetAction()
    {
        $contactInformations = $this->getDoctrine()->getManager()->getRepository('Rscine\AppBundle\Entity\ContactInformation')->findAll();

        return $contactInformations;
    }

    /**
     * Crée un utilisateur client
     * POST api/contactInformations
     */
    public function postAction(Request $request)
    {
        $contactInformation = new ContactInformation();

        $registrationForm = $this->createContactInformationRegistrationForm($contactInformation);

        $registrationForm->submit($request->get($registrationForm->getName()));

        if ($registrationForm->isValid() && $registrationForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($contactInformation);
            $this->getDoctrine()->getManager()->flush();

            return $contactInformation;
        }

        return new JsonResponse($this->get('serializer')->toArray($registrationForm), 400);
    }

    /**
     * Modifie un utilisateur client
     * PUT api/contactInformations/{slug}
     *
     * @ParamConverter("contactInformation", class="RscineAppBundle:ContactInformation")
     */
    public function putAction(Request $request, ContactInformation $contactInformation)
    {
        $profileForm = $this->createContactInformationProfileForm($contactInformation);

        $profileForm->submit($request->get($profileForm->getName()));

        if ($profileForm->isValid() && $profileForm->isSubmitted()) {

              $this->getDoctrine()->getManager()->persist($contactInformation);
              $this->getDoctrine()->getManager()->flush();

              return $contactInformation;
        }

        return new JsonResponse($this->get('serializer')->toArray($profileForm->getErrors()));
    }

    /**
     * Récupère les options possibles pour un utilisateur client
     * OPTIONS api/contactInformations/{slug}
     *
     * @ParamConverter("contactInformation", class="RscineAppBundle:ContactInformation")
     */
    public function optionsAction(ContactInformation $contactInformation)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');

        return $response;
    }

    /**
     * Récupère les options possibles pour tous les utilisateurs clients
     * OPTIONS api/contactInformations
     */
    public function coptionsAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');

        return $response;
    }

    /**
     * Supprime un utilisateur client $contactInformation
     * DELETE api/contactInformations/{slug}
     *
     * @ParamConverter("contactInformation", class="RscineAppBundle:ContactInformation")
     */
    public function deleteAction(ContactInformation $contactInformation)
    {
        $this->getDoctrine()->getManager()->remove($contactInformation);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('Message' => 'ContactInformation deleted'), 200);
    }

    /**
     * Retourne le formulaire de création d'un utilisateur client
     *
     * @param  ContactInformation $contactInformation [description]
     * @return [type]             [description]
     */
    private function createContactInformationRegistrationForm(ContactInformation $contactInformation)
    {
        $contactInformationRegistrationType = $this->createForm(new ContactInformationRegistrationType(), $contactInformation);

        return $contactInformationRegistrationType;
    }

    /**
     * Retourne le forumaire d'édition de profil d'un utilisateur client
     *
     * @param  ContactInformation $contactInformation [description]
     * @return [type]             [description]
     */
    private function createContactInformationProfileForm(ContactInformation $contactInformation)
    {
        $contactInformationProfileForm = $this->createForm(new ContactInformationProfileType(), $contactInformation);

        return $contactInformationProfileForm;
    }
}
