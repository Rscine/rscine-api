<?php

namespace Rscine\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Rscine\AppBundle\Entity\ContactInformation;

/**
 * Phone
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("ALL")
 */
class Phone
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
     *
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="ContactInformation", inversedBy="phones")
     * @ORM\JoinColumn(name="contact_information_id", referencedColumnName="id")
     */
    private $contactInformation;

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
     * Set number
     *
     * @param string $number
     *
     * @return Phone
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Phone
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set contactInformation
     *
     * @param \Rscine\AppBundle\Entity\ContactInformation $contactInformation
     *
     * @return Phone
     */
    public function setContactInformation(\Rscine\AppBundle\Entity\ContactInformation $contactInformation = null)
    {
        $this->contactInformation = $contactInformation;

        return $this;
    }

    /**
     * Get contactInformation
     *
     * @return \Rscine\AppBundle\Entity\ContactInformation
     */
    public function getContactInformation()
    {
        return $this->contactInformation;
    }
}
