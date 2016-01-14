<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Domain;
use AppBundle\Entity\User;
use AppBundle\Model\ContractorInterface;
use AppBundle\Model\ContractorTrait;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Worker
 * 
 * @ORM\Table(name="worker")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"individual" = "Individual", "company" = "Company"})
 * @Serializer\ExclusionPolicy("ALL")
 */
abstract class Worker extends User implements ContractorInterface
{

    use Contractortrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Domain", inversedBy="workers")
     * @ORM\JoinColumn(name="domain_id", referencedColumnName="id")
     * @var Domain
     */
    private $domain;

    /**
     * @ORM\ManyToMany(targetEntity="Profile", mappedBy="workers")
     * @var Profile
     */
    private $profiles;

    /**
     * @ORM\ManyToMany(targetEntity="Genre", mappedBy="workers")
     * @var Genre
     */
    private $genres;


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
     * Set domain to the worker
     * @param Domain $domain 
     * @return Worker
     */
    public function setDomain(Domain $domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get the worker domain
     * @return Domain $domain
     */
    public function getDomain()
    {
        return $this->domain;
    }
}

