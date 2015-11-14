<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use JMS\Serializer\Annotation as Serializer;
use AppBundle\Entity\Contractor;
use AppBundle\Entity\Customer;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({"contractor" = "Contractor", "customer" = "Customer"})
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("ALL")
 */
abstract class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="users")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    private $department;

    /**
     * @ORM\OneToOne(targetEntity="ContactInformations", cascade={"persist"})
     * @ORM\JoinColumn(name="contact_informations_id", referencedColumnName="id")
     */
    private $contactInformations;

    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("department_id")
     */
    public function getDepartmentId()
    {
        return ($this->getDepartment()) ? $this->getDepartment()->getId() : null;
    }

    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("contact_emails")
     */
    public function getContactEmails()
    {
        $contactEmails = array();

        if ($this->getContactInformations()) {

            foreach ($this->getContactInformations()->getEmails() as $email) {
                $contactEmails[] = $email->getEmail();
            }

        }

        return $contactEmails;
    }


    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("contact_phones")
     */
    public function getContactPhones()
    {
        $contactPhones = array();

        if ($this->getContactInformations()) {

            foreach ($this->getContactInformations()->getPhones() as $phone) {
                $contactPhones[] = $phone->getNumber();
            }

        }

        return $contactPhones;
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
     * Set login
     *
     * @param string $login
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * Set department
     *
     * @param \AppBundle\Entity\Department $department
     *
     * @return User
     */
    public function setDepartment(\AppBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \AppBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set contactInformations
     *
     * @param \AppBundle\Entity\ContactInformations $contactInformations
     *
     * @return User
     */
    public function setContactInformations(\AppBundle\Entity\ContactInformations $contactInformations = null)
    {
        $this->contactInformations = $contactInformations;

        return $this;
    }

    /**
     * Get contactInformations
     *
     * @return \AppBundle\Entity\ContactInformations
     */
    public function getContactInformations()
    {
        return $this->contactInformations;
    }
}
