<?php

namespace Rscine\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rscine\AppBundle\Entity\Worker;

/**
 * Genre
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var String
     * 
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Domain
     * @ORM\ManyToOne(targetEntity="Domain", inversedBy="availableGenres")
     */
    private $domain;

    /**
     * @var ArrayCollection<Worker>
     * @ORM\ManyToMany(targetEntity="Rscine\AppBundle\Entity\Worker", inversedBy="genres")
     */
    private $workers;

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
     * Constructor
     */
    public function __construct()
    {
        $this->workers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Genre
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set domain
     *
     * @param \Rscine\AppBundle\Entity\Domain $domain
     *
     * @return Genre
     */
    public function setDomain(\Rscine\AppBundle\Entity\Domain $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return \Rscine\AppBundle\Entity\Domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Add worker
     *
     * @param \Rscine\AppBundle\Entity\User $worker
     *
     * @return Genre
     */
    public function addWorker(\Rscine\AppBundle\Entity\User $worker)
    {
        $this->workers[] = $worker;

        return $this;
    }

    /**
     * Remove worker
     *
     * @param \Rscine\AppBundle\Entity\User $worker
     */
    public function removeWorker(\Rscine\AppBundle\Entity\User $worker)
    {
        $this->workers->removeElement($worker);
    }

    /**
     * Get workers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkers()
    {
        return $this->workers;
    }
}
