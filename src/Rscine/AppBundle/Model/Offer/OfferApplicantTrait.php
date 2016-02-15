<?php

namespace Rscine\AppBundle\Model\Offer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Représente un utilisateur pouvant candidater à des offres
 */
trait OfferApplicantTrait
{
    /**
     * @var ArrayCollection<Offer>
     *
     * @ORM\ManyToMany(targetEntity="Offer", mappedBy="applicants")
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

            $offer->addApplicant($this);
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

            $offer->getApplicants()->removeElement($this);
        }

        return $this;
    }
}
