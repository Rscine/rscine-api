<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use JMS\Serializer\Annotation as Serializer;
use AppBundle\Model\UserInterface;
use AppBundle\Entity\Company;

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

    public function getCompanyId()
    {
        return ($this->getCompany()) ? $this->getCompany()->getId() : null;
    }

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
}
