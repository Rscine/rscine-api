<?php

namespace Rscine\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

use Rscine\AppBundle\Entity\Email;
use Rscine\AppBundle\Entity\Phone;

/**
 * ContactInformation
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @Serializer\ExclusionPolicy("ALL")
 */
class ContactInformation
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
     * @ORM\OneToMany(targetEntity="Email", mappedBy="contactInformation", cascade={"persist"})
     */
    private $emails;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="contactInformation", cascade={"persist"})
     */
    private $phones;

    /**
     * @var Address
     *
     * @ORM\OneToMany(targetEntity="Address", mappedBy="contactInformation", cascade={"persist"})
     */
    private $addresses;

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
     * Set emails
     *
     * @param array $emails
     *
     * @return ContactInformation
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Get emails
     *
     * @return array
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set phones
     *
     * @param string $phones
     *
     * @return ContactInformation
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;

        return $this;
    }

    /**
     * Get phones
     *
     * @return string
     */
    public function getPhones()
    {
        return $this->phones;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->phones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add phone
     *
     * @param \Rscine\AppBundle\Entity\Phone $phone
     *
     * @return ContactInformation
     */
    public function addPhone(\Rscine\AppBundle\Entity\Phone $phone)
    {
        $this->phones[] = $phone;
        $phone->setContactInformation($this);

        return $this;
    }

    /**
     * Remove phone
     *
     * @param \Rscine\AppBundle\Entity\Phone $phone
     */
    public function removePhone(\Rscine\AppBundle\Entity\Phone $phone)
    {
        $this->phones->removeElement($phone);
    }

    /**
     * Add email
     *
     * @param \Rscine\AppBundle\Entity\Email $email
     *
     * @return ContactInformation
     */
    public function addEmail(\Rscine\AppBundle\Entity\Email $email)
    {
        $this->emails[] = $email;
        $email->setContactInformation($this);

        return $this;
    }

    /**
     * Remove email
     *
     * @param \Rscine\AppBundle\Entity\Email $email
     */
    public function removeEmail(\Rscine\AppBundle\Entity\Email $email)
    {
        $this->emails->removeElement($email);
    }
}
