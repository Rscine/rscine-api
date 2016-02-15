<?php

namespace Rscine\AppBundle\Model\Offer;

/**
 * Représente un utilisateur pouvant candidater à des offres
 */
interface OfferApplierInterface
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
     * @return OfferApplierInterface
     */
    public function addOfferAppliedTo(Offer $offer);

    /**
     * Removes an offer form the offers applied to
     *
     * @param  Offer  $offer
     *
     * @return OfferApplierInterface
     */
    public function removeOfferAppliedTo(Offer $offer);
}
