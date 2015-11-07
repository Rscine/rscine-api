<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Offer
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("ALL")
 */
class Offer
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
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Serializer\Expose
     */
    private $description;

    /**
     * Créateur de la demande (utilisateur client)
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="offers")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    private $creator;

    /**
     * Candidats à la demande
     * @var Array<Contractor>
     *
     * @ORM\OneToMany(targetEntity="Contractor", mappedBy="offersAppliedTo")
     */
    private $applicants;

    /**
     * Maître d'oeuvre
     * @var Contractor
     *
     * @ORM\ManyToOne(targetEntity="Contractor", inversedBy="offersHandled")
     * @ORM\JoinColumn(name="handler_id", referencedColumnName="id")
     */
    private $handler;

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
     * @return Offer
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
     * Set description
     *
     * @param string $description
     *
     * @return Offer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

