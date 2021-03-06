<?php

namespace OfferBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use OfferBundle\Entity\Offer;

/**
 * Représente un utilisateur pouvant candidater à des offres
 */
trait OfferApplicantTrait
{
    /**
     * @var ArrayCollection<Offer>
     *
     * @ORM\ManyToMany(targetEntity="OfferBundle\Entity\Offer", mappedBy="applicants")
     */
    private $offersAppliedTo;

    /**
     * @{inheritdoc}
     */
    public function getOffersAppliedTo()
    {
        return $this->offersAppliedTo;
    }

    /**
     * @{inheritdoc}
     */
    public function addOfferAppliedTo(Offer $offer)
    {
        if (!$this->offersAppliedTo->contains($offer)) {
            $this->offersAppliedTo->add($offer);
        }

        return $this;
    }

    /**
     * @{inheritdoc}
     */
    public function removeOfferAppliedTo(Offer $offer)
    {
        if ($this->offersAppliedTo->contains($offer)) {
            $this->offersAppliedTo->removeElement($offer);
        }

        return $this;
    }
}
