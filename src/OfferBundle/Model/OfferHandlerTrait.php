<?php

namespace OfferBundle\Model;

use OfferBundle\Entity\Offer;

/**
 * Représente un utilisateur pouvant s'occuper des offres
 */
trait OfferHandlerTrait
{
    /**
     * @var ArrayCollection<Offer>
     *
     * @ORM\OneToMany(targetEntity="OfferBundle\Entity\Offer", mappedBy="handler")
     */
    private $offersHandled;

    /**
     * @{inheritdoc}
     */
    public function getOffersHandled()
    {
        return $this->offersHandled;
    }

    /**
     * @{inheritdoc}
     */
    public function addOfferHandled(Offer $offer)
    {
        if (!$this->offersHandled->contains($offer)) {
            $this->offersHandled->add($offer);

            $offer->setHandler($this);
        }

        return $this;
    }

    /**
     * @{inheritdoc}
     */
    public function removeOfferHandled(Offer $offer)
    {
        if ($this->offersHandled->contains($offer)) {
            $this->offersHandled->removeElement($offer);

            $offer->setHandler(null);
        }

        return $this;
    }
}
