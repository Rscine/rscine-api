<?php

namespace Rscine\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

use Rscine\AppBundle\Entity\User;
use Rscine\AppBundle\Entity\Company;
use Rscine\AppBundle\Model\Offer\OfferApplicantInterface;
use Rscine\AppBundle\Model\Offer\OfferApplicantTrait;
use Rscine\AppBundle\Model\Offer\OfferHandlerInterface;
use Rscine\AppBundle\Model\Offer\OfferHandlerTrait;

/**
 * Worker
 *
 * @ORM\Table(name="worker")
 * @ORM\Entity()
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"individual" = "Individual", "company" = "Company"})
 *
 * @Serializer\ExclusionPolicy("ALL")
 */
abstract class Worker extends User implements OfferApplicantInterface, OfferHandlerInterface
{
    use OfferHandlerTrait;
    use OfferApplicantTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Expose()
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Profile", mappedBy="workers")
     * @var Profile
     *
     * @Serializer\Expose()
     */
    private $profiles;

    /**
     * @ORM\ManyToMany(targetEntity="Genre", mappedBy="workers")
     * @var Genre
     *
     * @Serializer\Expose()
     */
    private $genres;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
