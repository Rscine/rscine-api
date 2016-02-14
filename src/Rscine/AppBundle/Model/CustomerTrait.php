<?php 

namespace Rscine\AppBundle\Model;

/**
 * Customer
 * @Serializer\ExclusionPolicy("ALL")
 */
trait CustomerTrait {

    /**
     * Offres créées par le customer
     * @var Array<Offer>
     * 
     * @ORM\OneToMany(targetEntity="Offer", mappedBy="creator")
     */
    private $offersCreated;

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