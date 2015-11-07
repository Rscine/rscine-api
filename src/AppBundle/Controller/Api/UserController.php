<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\User;
use AppBundle\Form\RegistrationType;
use AppBundle\Form\ProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializerBuilder;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends FOSRestController
{


    /**
     * Récupère tous les utilisateurs
     * GET api/users
     * @Rest\View()
     *
     * @return [type] [description]
     */
    public function getUsersAction()
    {
        $users = $this->getDoctrine()->getManager()->getRepository('AppBundle:User')->findAll();
        return $users;
    }


    /**
     * Récupère un utilisateur
     * GET api/users/{slug}
     * @Rest\View()
     * @ParamConverter("user", class="AppBundle:User")
     *
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function getUserAction(User $user)
    {
        return $user;
    }

    /**
     * Modifie un utilisateur
     * PATCH api/users/{slug}
     * @ParamConverter("user", class="AppBundle:User")
     *
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function patchUserAction(Request $request, User $user)
    {
        $profileForm = $this->createProfileForm($user);

        $profileForm->submit($request->request->get($profileForm->getName()));

        if ($profileForm->isValid() && $profileForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($this->get('serializer')->toArray($user), 200);
        }

        return new JsonResponse($this->get('serializer')->toArray($profileForm->getErrors()), 400);
    }

    /**
     * Modifie un utilisateur
     * PUT api/users/{slug}
     * @ParamConverter("user", class="AppBundle:User")
     *
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function putUserAction(Request $request, $user)
    {
        $profileForm = $this->createProfileForm($user);

        $profileForm->submit($request->request->get($profileForm->getName()));

        if ($profileForm->isValid() && $profileForm->isSubmitted()) {

            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($this->get('serializer')->toArray($user), 200);
        }

        return new JsonResponse($this->get('serializer')->toArray($profileForm->getErrors()), 400);
    }

    /**
     * Retourne les options possibles pour tous les utilisateurs
     * OPTIONS api/users
     *
     * @return [type]       [description]
     */
    public function optionsUsersAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, PUT, DELETE');

        return $response;
    }

    /**
     * Retourne les options possibles pour un utilisateur
     * OPTIONS api/users/{slug}
     * @ParamConverter("user", class="AppBundle:User")
     *
     * @return [type]       [description]
     */
    public function optionsUserAction(User $user)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, PUT, DELETE');

        return $response;
    }

    /**
     * Supprime l'utilisateur $user
     * DELETE api/users/{slug}
     * @ParamConverter("user", class="AppBundle:User")
     *
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function deleteUserAction($user)
    {
        $this->getDoctrine()->getManager()->remove($user);
        $this->getDoctrine()->getManager()->flush();
        return null;
    }

    /**
     * Retourne le formulaire d'édition d'un utilisateur
     *
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function createProfileForm(User $user)
    {
        $profileForm = $this->createForm(new ProfileType(), $user);

        return $profileForm;
    }

    /**
     * Retourne le formulaire d'inscritpion d'un utilisateur
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function createRegistrationForm(User $user)
    {
        $registrationForm = $this->createForm(new RegistrationType(), $user);

        return $registrationForm;
    }


}
