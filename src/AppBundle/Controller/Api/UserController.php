<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;

class UserController extends FOSRestController
{


    /**
     * Récupère tous les utilisateurs
     * GET api/users
     * 
     * @return [type] [description]
     */
    public function getUsersAction()
    {
        
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
