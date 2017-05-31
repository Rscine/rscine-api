<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

use OfferBundle\Model\OfferCreatorInterface;
use OfferBundle\Model\OfferCreatorTrait;
use SocialBundle\Entity\District;
use SocialBundle\Entity\ContactInformation;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"worker" = "SocialBundle\Entity\Worker", "company" = "SocialBundle\Entity\Company", "person" = "SocialBundle\Entity\Person", "user" = "User"})
 *
 * @Serializer\ExclusionPolicy("ALL")
 *
 * @Hateoas\Relation(
 *     "contactInformation",
 *     embedded = "expr(object.getContactInformation())",
 *     exclusion = @Hateoas\Exclusion(excludeIf = "expr(object.getContactInformation() === null)")
 * )
 */
class User extends BaseUser implements OfferCreatorInterface
{
    use OfferCreatorTrait;

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
     * @ORM\OneToOne(targetEntity="SocialBundle\Entity\ContactInformation", cascade={"persist"})
     * @ORM\JoinColumn(name="contact_informations_id", referencedColumnName="id")
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
     * Set district
     *
     * @param District $district
     *
     * @return User
     */
    public function setDistrict(District $district = null)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return District
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set contactInformation
     *
     * @param ContactInformation $contactInformation
     *
     * @return User
     */
    public function setContactInformation(ContactInformation $contactInformation = null)
    {
        $this->contactInformation = $contactInformation;

        return $this;
    }

    /**
     * Get contactInformation
     *
     * @return \SocialBundle\Entity\ContactInformation
     */
    public function getContactInformation()
    {
        return $this->contactInformation;
    }
}
