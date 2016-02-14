<?php

namespace Rscine\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Email
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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="ContactInformations", inversedBy="phones")
     * @ORM\JoinColumn(name="contact_information_id", referencedColumnName="id")
     */
    private $contactInformations;


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
     * Set email
     *
     * @param string $email
     *
     * @return Email
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set type
     *
     * @param \stdClass $type
     *
     * @return Email
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \stdClass
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set contactInformations
     *
     * @param \Rscine\AppBundle\Entity\ContactInformations $contactInformations
     *
     * @return Email
     */
    public function setContactInformations(\Rscine\AppBundle\Entity\ContactInformations $contactInformations = null)
    {
        $this->contactInformations = $contactInformations;

        return $this;
    }

    /**
     * Get contactInformations
     *
     * @return \Rscine\AppBundle\Entity\ContactInformations
     */
    public function getContactInformations()
    {
        return $this->contactInformations;
    }
}
