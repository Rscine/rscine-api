<?php

namespace Rscine\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rscine\AppBundle\Entity\Worker;
use JMS\Serializer\Annotation as Serializer;
use Rscine\AppBundle\Entity\Company;


/**
 * Individual
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("ALL")
 */
class Individual extends Worker
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
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="employees")
     */
    protected $company;

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
     * Set company
     *
     * @param Company $company
     *
     * @return Individual
     */
    public function setCompany(Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}
