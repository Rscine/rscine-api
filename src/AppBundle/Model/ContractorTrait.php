<?php 

namespace AppBundle\Model;

use AppBundle\Entity\Offer;
use AppBundle\Entity\Company;

/**
 * Contractor
 *
 * @Serializer\ExclusionPolicy("ALL")
 */
trait ContractorTrait {

    /**
     * @var integer
     *
     * @ORM\Column(name="rate", type="integer", nullable=true)
     */
    private $rate;

    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="employees")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * @var Company
     */
    private $company;

    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("company_id")
     */
    public function getCompanyId()
    {
        return ($this->getCompany()) ? $this->getCompany()->getId() : null;
    }

    /**
     * Offres auxquelles le contractor a candidaté
     * @var Array<Offer>
     * 
     * @ORM\ManyToMany(targetEntity="Offer", mappedBy="applicants")
     */     
    private $offersAppliedTo;

    /**
     * @ORM\OneToMany(targetEntity="Offer", mappedBy="handler")
     */
    private $offersHandled;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     *
     * @return Contractor
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Contractor
     */
    public function setCompany(Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add offersAppliedTo
     *
     * @param \AppBundle\Entity\Offer $offersAppliedTo
     *
     * @return Contractor
     */
    public function addOfferAppliedTo(Offer $offerAppliedTo)
    {
        $this->offerAppliedTo[] = $offerAppliedTo;

        return $this;
    }

    /**
     * Remove offersAppliedTo
     *
     * @param \AppBundle\Entity\Offer $offersAppliedTo
     */
    public function removeOfferAppliedTo(Offer $offerAppliedTo)
    {
        $this->offerAppliedTo->removeElement($offerAppliedTo);
    }

    /**
     * Get offersAppliedTo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffersAppliedTo()
    {
        return $this->offersAppliedTo;
    }

    /**
     * Add offersHandled
     *
     * @param \AppBundle\Entity\Contractor $offersHandled
     *
     * @return Contractor
     */
    public function addOfferHandled(Offer $offerHandled)
    {
        $this->offerHandled[] = $offerHandled;

        return $this;
    }

    /**
     * Remove offersHandled
     *
     * @param \AppBundle\Entity\Contractor $offersHandled
     */
    public function removeOfferHandled(Offer $offerHandled)
    {
        $this->offerHandled->removeElement($offersHandled);
    }

    /**
     * Get offersHandled
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffersHandled()
    {
        return $this->offersHandled;
    }
}