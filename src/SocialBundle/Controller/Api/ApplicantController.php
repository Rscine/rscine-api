<?php

namespace SocialBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use OfferBundle\Entity\Offer;
use SocialBundle\Entity\Worker;
use UserBundle\Entity\User;
use Rscine\AppBundle\Form\ProfileType;
use Rscine\AppBundle\Form\RegistrationType;
/**
 * @Rest\RouteResource("Applicant")
 */
class ApplicantController extends FOSRestController
{
    /**
     * Récupère tous les candidats de l'offre $offer
     * GET api/v1/offers/{offer}/applicants
     *
     * @param  Offer $offer
     *
     * @Rest\View()
     * @ParamConverter("offer", class="RscineOfferBundle:Offer")
     */
    public function cgetAction(Offer $offer)
    {
        $applicants = $offer->getApplicants();

        return $applicants;
    }

    /**
     * Supprime le candidat $applicant de l'offre $offer
     * DELETE api/v1/offers/{offer}/applicants/{applicant}
     *
     * @ParamConverter("offer", class="RscineOfferBundle:Offer")
     * @ParamConverter("applicant", class="RscineWorkerBundle:Worker")
     */
    public function deleteAction(Offer $offer, Worker $applicant)
    {
        if ($offer->getApplicants()->contains($applicant)) {
            $offer->removeApplicant($applicant);

            $this->getDoctrine()->getManager()->persist($offer);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse(array('Message' => 'Applicant deleted'), 200);
        }

        return new JsonResponse(array('Message' => 'Applicant not found for this offer'), 404);
    }
}
