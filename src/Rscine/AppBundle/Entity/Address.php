<?php

namespace Rscine\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * Address
 *
 * @ORM\Table()
 * @ORM\Entity()
 *
 * @Serializer\ExclusionPolicy("ALL")
 *
 * @Hateoas\Relation(
 *     "contactInformation",
 *     href = @Hateoas\Route("get_contactinformation", parameters={"contactInformation" = "expr(object.getContactInformation().getId())"}),
 *     exclusion = @Hateoas\Exclusion(excludeIf = "expr(object.getContactInformation() === null)")
 * )
 */
class Address
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="text")
     *
     * @Serializer\Expose()
     */
    private $street;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer")
     *
     * @Serializer\Expose()
     */
    private $number;

    /**
     * @var integer
     *
     * @ORM\Column(name="postalCode", type="integer")
     *
     * @Serializer\Expose()
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="complements", type="text")
     *
     * @Serializer\Expose()
     */
    private $complements;

    /**
     * @var ContactInformation
     *
     * @ORM\ManyToOne(targetEntity="ContactInformation", inversedBy="addresses")
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
     * Set street
     *
     * @param string $street
     *
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Address
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
     * Set postalCode
     *
     * @param integer $postalCode
     *
     * @return Address
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return integer
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set complements
     *
     * @param string $complements
     *
     * @return Address
     */
    public function setComplements($complements)
    {
        $this->complements = $complements;

        return $this;
    }

    /**
     * Get complements
     *
     * @return string
     */
    public function getComplements()
    {
        return $this->complements;
    }
}
