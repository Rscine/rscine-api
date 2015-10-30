<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializerBuilder;

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
     * [postUsersAction description]
     * @return [type] [description]
     */
    public function postUsersAction()
    {

    }

    /**
     * Récupère un ustilisateur suivant le slug
     * GET api/users/{slug}
     *
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function getUserAction($slug)
    {

    }

    /**
     * Modifie un utilisateur
     * PATCH api/users/{slug}
     *
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function editUserAction($slug)
    {

    }

}
