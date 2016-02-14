<?php

namespace Rscine\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Domain
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Domain
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
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var ArrayCollection<Profile>
     * @ORM\OneToMany(targetEntity="Profile", mappedBy="domain", cascade={"persist"})
     */
    private $availableProfiles;

    /**
     * @var ArrayCollection<Genre>
     * @ORM\OneToMany(targetEntity="Genre", mappedBy="domain", cascade={"persist"})
     */
    private $availableGenres;

    /**
     * @var Worker
     * @ORM\OneToMany(targetEntity="Rscine\AppBundle\Entity\Worker", mappedBy="domain", cascade={"persist"})
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
        $this->availableProfiles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->availableGenres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Domain
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
     * Add availableProfile
     *
     * @param \Rscine\AppBundle\Entity\Profile $availableProfile
     *
     * @return Domain
     */
    public function addAvailableProfile(\Rscine\AppBundle\Entity\Profile $availableProfile)
    {
        $this->availableProfiles[] = $availableProfile;
        $availableProfile->setDomain($this);

        return $this;
    }

    /**
     * Remove availableProfile
     *
     * @param \Rscine\AppBundle\Entity\Profile $availableProfile
     */
    public function removeAvailableProfile(\Rscine\AppBundle\Entity\Profile $availableProfile)
    {
        $this->availableProfiles->removeElement($availableProfile);
        $availableProfile->setDomain(null);
    }

    /**
     * Get availableProfiles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAvailableProfiles()
    {
        return $this->availableProfiles;
    }

    /**
     * Add availableGenre
     *
     * @param \Rscine\AppBundle\Entity\Genre $availableGenre
     *
     * @return Domain
     */
    public function addAvailableGenre(\Rscine\AppBundle\Entity\Genre $availableGenre)
    {
        $this->availableGenres[] = $availableGenre;
        $availableGenre->setDomain($this);

        return $this;
    }

    /**
     * Remove availableGenre
     *
     * @param \Rscine\AppBundle\Entity\Genre $availableGenre
     */
    public function removeAvailableGenre(\Rscine\AppBundle\Entity\Genre $availableGenre)
    {
        $this->availableGenres->removeElement($availableGenre);
        $availableGenre->setDomain(null);
    }

    /**
     * Get availableGenres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAvailableGenres()
    {
        return $this->availableGenres;
    }
}
