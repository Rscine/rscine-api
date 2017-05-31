<?php

namespace SocialBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use SocialBundle\Entity\Person;
use Rscine\AppBundle\Form\RegistrationType as PersonRegistrationType;
use Rscine\AppBundle\Form\ProfileType as PersonProfileType;

class PersonController extends FOSRestController
{
    /**
     * Récupère un utilisateur client
     * GET api/persons/{slug}
     *
     * @Rest\View()
     * @ParamConverter("person", class="SocialBundle:Person")
     */
    public function getPersonAction(Person $person)
    {
        return $person;
    }

    /**
     * Récupère tous les utilisateurs clients
     * GET api/persons
     *
     * @Rest\View()
     */
    public function getPersonsAction()
    {
        $persons = $this->getDoctrine()->getManager()->getRepository('SocialBundle\Entity\Person')->findAll();

        return $persons;
    }

    /**
     * Crée un utilisateur client
     * POST api/persons
     */
    public function postPersonAction(Request $request)
    {
        $person = new Person();

        $registrationForm = $this->createPersonRegistrationForm($person);

        $registrationForm->submit($request->get($registrationForm->getName()));

        if ($registrationForm->isValid() && $registrationForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($person);
            $this->getDoctrine()->getManager()->flush();

            return $person;
        }

        return new JsonResponse($this->get('serializer')->toArray($registrationForm), 400);
    }

    /**
     * Modifie un utilisateur client
     * PUT api/persons/{slug}
     *
     * @ParamConverter("person", class="SocialBundle:Person")
     */
    public function putPersonAction(Request $request, Person $person)
    {
        $profileForm = $this->createPersonProfileForm($person);

        $profileForm->submit($request->get($profileForm->getName()));

        if ($profileForm->isValid() && $profileForm->isSubmitted()) {

              $this->getDoctrine()->getManager()->persist($person);
              $this->getDoctrine()->getManager()->flush();

              return $person;
        }

        return new JsonResponse($this->get('serializer')->toArray($profileForm->getErrors()));
    }

    /**
     * Récupère les options possibles pour un utilisateur client
     * OPTIONS api/persons/{slug}
     *
     * @ParamConverter("person", class="SocialBundle:Person")
     */
    public function optionsPersonAction(Person $person)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');

        return $response;
    }

    /**
     * Récupère les options possibles pour tous les utilisateurs clients
     * OPTIONS api/persons
     */
    public function optionsPersonsAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');

        return $response;
    }

    /**
     * Supprime un utilisateur client $person
     * DELETE api/persons/{slug}
     *
     * @ParamConverter("person", class="SocialBundle:Person")
     */
    public function deletePersonAction(Person $person)
    {
        $this->getDoctrine()->getManager()->remove($person);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('Message' => 'Person deleted'), 200);
    }

    /**
     * Retourne le formulaire de création d'un utilisateur client
     *
     * @param  Person $person [description]
     * @return [type]             [description]
     */
    private function createPersonRegistrationForm(Person $person)
    {
        $personRegistrationType = $this->createForm(new PersonRegistrationType(), $person);

        return $personRegistrationType;
    }

    /**
     * Retourne le forumaire d'édition de profil d'un utilisateur client
     *
     * @param  Person $person [description]
     * @return [type]             [description]
     */
    private function createPersonProfileForm(Person $person)
    {
        $personProfileForm = $this->createForm(new PersonProfileType(), $person);

        return $personProfileForm;
    }
}
