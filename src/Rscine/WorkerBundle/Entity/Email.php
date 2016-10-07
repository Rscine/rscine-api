<?php

namespace Rscine\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * Email
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
class Email
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
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Serializer\Expose()
     */
    private $email;

    /**
     * @ORM\Column(name="type", type="string", length=255)
     *
     * @Serializer\Expose()
     * @Serializer\SerializedName("email_type")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="ContactInformation", inversedBy="emails")
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
     * Set contactInformation
     *
     * @param ContactInformation $contactInformation
     *
     * @return Email
     */
    public function setContactInformation(ContactInformation $contactInformation = null)
    {
        $this->contactInformation = $contactInformation;

        return $this;
    }

    /**
     * Get contactInformation
     *
     * @return ContactInformation
     */
    public function getContactInformation()
    {
        return $this->contactInformation;
    }
}
