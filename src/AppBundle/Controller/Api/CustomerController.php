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
use AppBundle\Entity\Customer;
use AppBundle\Form\CustomerRegistrationType;
use AppBundle\Form\CustomerProfileForm;

class CustomerController extends FOSRestController
{
    /**
     * Récupère un utilisateur client
     * GET api/customers/{slug}
     * 
     * @Rest\View()
     * @ParamConverter("customer", class="AppBundle:Customer")
     */
    public function getCustomerAction(Customer $customer)
    {
        return $customer;
    }

    /**
     * Récupère tous les utilisateurs clients
     * GET api/customers
     * 
     * @Rest\View()
     */
    public function getCustomersAction()
    {
        $customers = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Customer')->findAll();

        return $customers;  
    }

    /**
     * Crée un utilisateur client
     * POST api/customers
     */
    public function postCustomerAction(Request $request)
    {
        $customer = new Customer();

        $registrationForm = $this->createCustomerRegistrationForm($customer);

        $registrationForm->submit($request->get($registrationForm->getName()));

        if ($registrationForm->isValid() && $registrationForm->isSubmitted()) {
            
            $this->getDoctrine()->getManager()->persist($customer);
            $this->getDoctrine()->getManager()->flush();

            return $customer;
        }

        return new JsonResponse($this->get('serializer')->toArray($registrationForm), 400);
    }

    /**
     * Modifie un utilisateur client
     * PUT api/customers/{slug}
     * 
     * @ParamConverter("customer", class="AppBundle:Customer")
     */
    public function putCustomerAction(Request $request, Customer $customer)
    {
        $profileForm = $this->createCustomerProfileForm($customer);

        $profileForm->submit($request->get($profileForm->getName()));

        if ($profileForm->isValid() && $profileForm->isSubmitted()) {

              $this->getDoctrine()->getManager()->persist($customer);
              $this->getDoctrine()->getManager()->flsuh();

              return $customer;
        }

        return new JsonResponse($this->get('serializer')->toArray($profileForm->getErrors()));
    }

    /**
     * Récupère les options possibles pour un utilisateur client
     * OPTIONS api/customers/{slug}
     *
     * @ParamConverter("customer", class="AppBundle:Customer")
     */
    public function optionsCustomerAction(Customer $customer)
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');

        return $response;
    }

    /**
     * Récupère les options possibles pour tous les utilisateurs clients
     * OPTIONS api/customers
     */
    public function optionsCustomersAction()
    {
        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, PATCH, POST');

        return $response;
    }

    /**
     * Supprime un utilisateur client $customer
     * DELETE api/customers/{slug}
     * 
     * @ParamConverter("customer", class="AppBundle:Customer")
     */
    public function deleteCustomerAction(Customer $customer)
    {
        $this->getDoctrine()->getManager()->remove($customer);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(array('Message' => 'Customer deleted'), 200);
    }

    /**
     * Retourne le formulaire de création d'un utilisateur client
     * 
     * @param  Customer $customer [description]
     * @return [type]             [description]
     */
    private function createCustomerRegistrationForm(Customer $customer)
    {
        $customerRegistrationType = $this->createForm(new CustomerRegistrationType(), $customer);

        return $customerRegistrationType;
    }

    /**
     * Retourne le forumaire d'édition de profil d'un utilisateur client
     * 
     * @param  Customer $customer [description]
     * @return [type]             [description]
     */
    private function createCustomerProfileForm(Customer $customer)
    {
        $customerProfileForm = $this->createForm(new CustomerProfileForm(), $customer);

        return $customerProfileForm;
    }
}
