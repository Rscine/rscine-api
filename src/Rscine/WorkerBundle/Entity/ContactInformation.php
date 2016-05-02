<?php

namespace Rscine\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ContactInformation
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @Serializer\ExclusionPolicy("ALL")
 *
 * @Hateoas\Relation(
 *     "emails",
 *     embedded = "expr(object.getEmails())",
 *     exclusion = @Hateoas\Exclusion(excludeIf = "expr(object.getEmails() === null)")
 * )
 * @Hateoas\Relation(
 *     "addresses",
 *     embedded = "expr(object.getAddresses())",
 *     exclusion = @Hateoas\Exclusion(excludeIf = "expr(object.getAddresses() === null)")
 * )
 * @Hateoas\Relation(
 *     "phones",
 *     embedded = "expr(object.getPhones())",
 *     exclusion = @Hateoas\Exclusion(excludeIf = "expr(object.getPhones() === null)")
 * )
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
        $this->phones = new ArrayCollection();
    }

    /**
     * Add phone
     *
     * @param Phone $phone
     *
     * @return ContactInformation
     */
    public function addPhone(Phone $phone)
    {
        $this->phones[] = $phone;
        $phone->setContactInformation($this);

        return $this;
    }

    /**
     * Remove phone
     *
     * @param Phone $phone
     */
    public function removePhone(Phone $phone)
    {
        $this->phones->removeElement($phone);
    }

    /**
     * Add email
     *
     * @param Email $email
     *
     * @return ContactInformation
     */
    public function addEmail(Email $email)
    {
        $this->emails[] = $email;
        $email->setContactInformation($this);

        return $this;
    }

    /**
     * Remove email
     *
     * @param Email $email
     */
    public function removeEmail(Email $email)
    {
        $this->emails->removeElement($email);
    }

    /**
     * Add address
     *
     * @param Address $address
     *
     * @return ContactInformation
     */
    public function addAddress(Address $address)
    {
        $this->addresses[] = $address;
        $address->setContactInformation($this);

        return $this;
    }

    /**
     * Remove address
     *
     * @param Address $address
     */
    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
}
