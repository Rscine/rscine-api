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
use AppBundle\Entity\Company;

class CompanyController extends FOSRestController
{
    /**
     * Récupère un utilisateur client
     * GET api/companies/{slug}
     * 
     * @Rest\View()
     * @ParamConverter("company", class="AppBundle:Company")
     */
    public function getCompanyAction(Company $company)
    {
        return $company;
    }

    /**
     * Récupère tous les utilisateurs clients
     * GET api/companies
     * 
     * @Rest\View()
     */
    public function getCompaniesAction()
    {
        $companies = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Company')->findAll();

        return $companies;  
    }

    /**
     * Crée un utilisateur client
     * POST api/companies
     */
    public function postCompanyAction(Request $request)
    {
        $company = new Company();

        $createForm = $this->createCreateForm($company);

        $createForm->submit($request->get($createForm->getName()));

        if ($createForm->isValid() && $createForm->isSubmitted()) {
            
            $this->getDoctrine()->getManager()->persist($company);
            $this->getDoctrine()->getManager()->flush();

            return $company;
        }

        return new JsonResponse($this->get('serializer')->toArray($createForm), 400);
    }

    /**
     * Modifie un utilisateur client
     * PUT api/companies/{slug}
     * 
     * @ParamConverter("company", class="AppBundle:Company")
     */
    public function putCompanyAction(Request $request, Company $company)
    {
        $editForm = $this->createEditForm($company);

        $editForm->submit($request->get($editForm->getName()));

        if ($editForm->isValid() && $editForm->isSubmitted()) {

              $this->getDoctrine()->getManager()->persist($company);
              $this->getDoctrine()->getManager()->flsuh();

              return $company;
        }

        return new JsonResponse($this->get('serializer')->toArray($editForm->getErrors()));
    }

    /**
     * Récupère les options possibles pour un utilisateur client
     * OPTIONS api/companies/{slug}
     *
     * @ParamConverter("company", class="AppBundle:Company")
     */
    public function optionsCompanyAction(Company $company)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST, DELETE');

        return $response;
    }

    /**
     * Récupère les options possibles pour tous les utilisateurs clients
     * OPTIONS api/companies
     */
    public function optionsCompaniesAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST, DELETE');

        return $response;
    }

    /**
     * Supprime un utilisateur client $company
     * DELETE api/companies/{slug}
     * 
     * @ParamConverter("company", class="AppBundle:Company")
     */
    public function deleteCompanyAction(Company $company)
    {
        $this->getDoctrine()->getManager()->remove($company);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('Message' => 'Company deleted'), 200);
    }

    /**
     * Retourne le formulaire de création d'un utilisateur client
     * 
     * @param  Company $company [description]
     * @return [type]             [description]
     */
    private function createCreateForm(Company $company)
    {
        $createForm = $this->createForm(new CompanyType(), $company);

        return $createForm;
    }

    /**
     * Retourne le forumaire d'édition de profil d'un utilisateur client
     * 
     * @param  Company $company [description]
     * @return [type]             [description]
     */
    private function createEditForm(Company $company)
    {
        $editForm = $this->createForm(new CompanyType(), $company);

        return $editForm;
    }
}
