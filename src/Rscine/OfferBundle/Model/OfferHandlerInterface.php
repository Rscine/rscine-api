<?php

namespace Rscine\OfferBundle\Model;

use Rscine\AppBundle\Entity\Offer;

/**
 * Représente un utilisateur pouvant s'occuper des offres
 */
interface OfferHandlerInterface
{

    /**
     * Returns all the offers handled
     *
     * @return ArrayCollection<Offer>
     */
    public function getOffersHandled();

    /**
     * Adds an offer to the offer handled
     *
     * @param Offer $offer
     *
     * @return OfferHandlerInterface
     */
    public function addOfferHandled(Offer $offer);

    /**
     * Removes an offer from the offers handled
     *
     * @param  Offer  $offer
     *
     * @return OfferHandlerInterface
     */
    public function removeOfferHandled(Offer $offer);

}
