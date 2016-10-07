<?php

namespace Rscine\OfferBundle\Model;

use Rscine\OfferBundle\Entity\Offer;

/**
 * Représente un utilisateur pouvant créer des offres
 */
interface OfferCreatorInterface
{
    /**
     * Returns all the offers created
     *
     * @return ArrayCollection<Offer>
     */
    public function getOffersCreated();

    /**
     * Add an offer to the offers created
     *
     * @param offer $offer
     *
     * @return OfferCreatorInterface
     */
    public function addOfferCreated(Offer $offer);

    /**
     * Removes an offer form the offers created
     *
     * @param  Offer  $offer
     *
     * @return OfferCreatorInterface;
     */
    public function removeOfferCreated(Offer $offer);

}
