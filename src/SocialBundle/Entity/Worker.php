<?php

namespace SocialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

use UserBundle\Entity\User;
use SocialBundle\Entity\Company;
use OfferBundle\Model\OfferApplicantInterface;
use OfferBundle\Model\OfferApplicantTrait;
use OfferBundle\Model\OfferHandlerInterface;
use OfferBundle\Model\OfferHandlerTrait;
use SocialBundle\Entity\Profile;
use SocialBundle\Entity\Genre;
use OfferBundle\Entity\Offer;

/**
 * Worker
 *
 * @ORM\Table(name="worker")
 * @ORM\Entity()
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"person" = "Person", "company" = "Company"})
 *
 * @Serializer\ExclusionPolicy("ALL")
 *
 * @Hateoas\Relation(
 *     "profiles",
 *     embedded = "expr(object.getProfiles())",
 *     exclusion = @Hateoas\Exclusion(excludeIf = "expr(object.getProfiles() === null)")
 * )
 * @Hateoas\Relation(
 *     "genres",
 *     embedded = "expr(object.getGenres())",
 *     exclusion = @Hateoas\Exclusion(excludeIf = "expr(object.getGenres() === null)")
 * )
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
     */
    private $profiles;

    /**
     * @ORM\ManyToMany(targetEntity="Genre", mappedBy="workers")
     * @var Genre
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

    /**
     * Add profile
     *
     * @param Profile $profile
     *
     * @return Worker
     */
    public function addProfile(Profile $profile)
    {
        $this->profiles[] = $profile;

        return $this;
    }

    /**
     * Remove profile
     *
     * @param Profile $profile
     */
    public function removeProfile(Profile $profile)
    {
        $this->profiles->removeElement($profile);
    }

    /**
     * Get profiles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfiles()
    {
        return $this->profiles;
    }

    /**
     * Add genre
     *
     * @param Genre $genre
     *
     * @return Worker
     */
    public function addGenre(Genre $genre)
    {
        $this->genres[] = $genre;

        return $this;
    }

    /**
     * Remove genre
     *
     * @param Genre $genre
     */
    public function removeGenre(Genre $genre)
    {
        $this->genres->removeElement($genre);
    }

    /**
     * Get genres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Add offersHandled
     *
     * @param Offer $offersHandled
     *
     * @return Worker
     */
    public function addOffersHandled(Offer $offersHandled)
    {
        $this->offersHandled[] = $offersHandled;

        return $this;
    }

    /**
     * Remove offersHandled
     *
     * @param Offer $offersHandled
     */
    public function removeOffersHandled(Offer $offersHandled)
    {
        $this->offersHandled->removeElement($offersHandled);
    }

    /**
     * Add offersAppliedTo
     *
     * @param Offer $offersAppliedTo
     *
     * @return Worker
     */
    public function addOffersAppliedTo(Offer $offersAppliedTo)
    {
        $this->offersAppliedTo[] = $offersAppliedTo;

        return $this;
    }

    /**
     * Remove offersAppliedTo
     *
     * @param Offer $offersAppliedTo
     */
    public function removeOffersAppliedTo(Offer $offersAppliedTo)
    {
        $this->offersAppliedTo->removeElement($offersAppliedTo);
    }
}
