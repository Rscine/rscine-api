<?php

namespace Rscine\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Department
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("ALL")
 */
class Department
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Serializer\Expose
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer")
     * @Serializer\Expose
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="County", inversedBy="departments")
     * @ORM\JoinColumn(name="county_id", referencedColumnName="id")
     */
    private $county;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="department")
     */
    private $users;

    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("county_id")
     */
    public function getCountyId()
    {
        return ($this->getCounty()) ? $this->getCounty()->getId() : null;
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
     * Set name
     *
     * @param string $name
     *
     * @return Department
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
     * Set number
     *
     * @param integer $number
     *
     * @return Department
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set county
     *
     * @param \Rscine\AppBundle\Entity\County $county
     *
     * @return Department
     */
    public function setCounty(\Rscine\AppBundle\Entity\County $county = null)
    {
        $this->county = $county;

        return $this;
    }

    /**
     * Get county
     *
     * @return \Rscine\AppBundle\Entity\County
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Add user
     *
     * @param \Rscine\AppBundle\Entity\User $user
     *
     * @return Department
     */
    public function addUser(\Rscine\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Rscine\AppBundle\Entity\User $user
     */
    public function removeUser(\Rscine\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
