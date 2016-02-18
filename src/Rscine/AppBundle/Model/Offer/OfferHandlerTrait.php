<?php

namespace Rscine\AppBundle\Model\Offer;

use Rscine\AppBundle\Entity\Offer;

/**
 * Représente un utilisateur pouvant s'occuper des offres
 */
trait OfferHandlerTrait
{
    /**
     * @var ArrayCollection<Offer>
     *
     * @ORM\OneToMany(targetEntity="Offer", mappedBy="handler")
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
