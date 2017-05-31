<?php

namespace OfferBundle\Model;

use OfferBundle\Entity\Offer;

/**
 * Représente un utilisateur pouvant candidater à des offres
 */
interface OfferApplicantInterface
{
    /**
     * Returns all offers applied to
     *
     * @return ArrayCollection<Offer>
     */
    public function getOffersAppliedTo();

    /**
     * Add an offer to offers applied to
     *
     * @param Offer $offer
     *
     * @return OfferApplicantInterface
     */
    public function addOfferAppliedTo(Offer $offer);

    /**
     * Removes an offer form the offers applied to
     *
     * @param  Offer  $offer
     *
     * @return OfferApplicantInterface
     */
    public function removeOfferAppliedTo(Offer $offer);
}
