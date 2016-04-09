<?php

namespace Rscine\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

use Rscine\AppBundle\Model\Offer\OfferApplicantInterface;
use Rscine\AppBundle\Model\Offer\OfferCreatorInterface;
use Rscine\AppBundle\Model\Offer\OfferHandlerInterface;
use Rscine\AppBundle\Model\Timestampable\TimestampableInterface;
use Rscine\AppBundle\Model\Timestampable\TimestampableTrait;

/**
 * Offer
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("ALL")
 *
 * @Hateoas\Relation(
 *     "handler",
 *     href = @Hateoas\Route("get_user", parameters={"user" = "expr(object.getHandler().getId())"}),
 *     exclusion = @Hateoas\Exclusion(excludeIf = "expr(object.getHandler() === null)")
 * )
 * @Hateoas\Relation(
 *     "creator",
 *     href = @Hateoas\Route("get_user", parameters={"user" = "expr(object.getCreator().getId())"}),
 *     exclusion = @Hateoas\Exclusion(excludeIf = "expr(object.getCreator() === null)")
 * )
 */
class Offer implements TimestampableInterface
{
    use TimestampableTrait;

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
     * @var OfferCreatorInterface
     *
     * @ORM\ManyToOne(targetEntity="Rscine\AppBundle\Model\Offer\OfferCreatorInterface", inversedBy="offersCreated")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    private $creator;

    /**
     * Candidats à la demande
     * @var Array<OfferApplicantInterface>
     *
     * @ORM\ManyToMany(targetEntity="Rscine\AppBundle\Model\Offer\OfferApplicantInterface", inversedBy="offersAppliedTo", cascade={"persist"})
     * @ORM\JoinTable(name="offers_applications",
     *      joinColumns={@ORM\JoinColumn(name="offer_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="applicant_id", referencedColumnName="id")}
     *      )
     */
    private $applicants;

    /**
     * Maître d'oeuvre
     * @var OfferHandlerInterface
     *
     * @ORM\ManyToOne(targetEntity="Rscine\AppBundle\Model\Offer\OfferHandlerInterface", inversedBy="offersHandled")
     * @ORM\JoinColumn(name="handler_id", referencedColumnName="id")
     */
    private $handler;

    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("applicants")
     */
    public function getApplicantsIds()
    {
        $ids = array();
        foreach ($this->getApplicants() as $applicant) {
             $ids[] = $applicant->getId();
         }
         return $ids;
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->applicants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set creator
     *
     * @param OfferCreatorInterface $creator
     *
     * @return Offer
     */
    public function setCreator(OfferCreatorInterface $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return OfferCreatorInterface
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Add applicant
     *
     * @param OfferApplicantInterface $applicant
     *
     * @return Offer
     */
    public function addApplicant(OfferApplicantInterface $applicant)
    {
        $this->applicants[] = $applicant;
        $applicant->addOfferAppliedTo($this);

        return $this;
    }

    /**
     * Remove applicant
     *
     * @param OfferApplicantInterface $applicant
     */
    public function removeApplicant(OfferApplicantInterface $applicant)
    {
        $this->applicants->removeElement($applicant);
        $applicant->removeOfferAppliedTo($this);
    }

    /**
     * Get applicants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplicants()
    {
        return $this->applicants;
    }

    /**
     * Set handler
     *
     * @param OfferHandlerInterface $handler
     *
     * @return Offer
     */
    public function setHandler(OfferHandlerInterface $handler = null)
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Get handler
     *
     * @return OfferHandlerInterface
     */
    public function getHandler()
    {
        return $this->handler;
    }
}
