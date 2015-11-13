<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use JMS\Serializer\Annotation as Serializer;
use AppBundle\Model\UserInterface;
use AppBundle\Entity\Company;
use AppBundle\Entity\Offer;


/**
 * Contractor
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Contractor extends User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate", type="integer")
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
     * 
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
    public function setCompany(\AppBundle\Entity\Company $company = null)
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
    public function addOfferAppliedTo(\AppBundle\Entity\Offer $offerAppliedTo)
    {
        $this->offerAppliedTo[] = $offerAppliedTo;

        return $this;
    }

    /**
     * Remove offersAppliedTo
     *
     * @param \AppBundle\Entity\Offer $offersAppliedTo
     */
    public function removeOfferAppliedTo(\AppBundle\Entity\Offer $offerAppliedTo)
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
    public function addOfferHandled(\AppBundle\Entity\Contractor $offerHandled)
    {
        $this->offerHandled[] = $offerHandled;

        return $this;
    }

    /**
     * Remove offersHandled
     *
     * @param \AppBundle\Entity\Contractor $offersHandled
     */
    public function removeOfferHandled(\AppBundle\Entity\Contractor $offerHandled)
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
