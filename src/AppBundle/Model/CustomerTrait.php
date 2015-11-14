<?php 

namespace AppBundle\Model;

/**
 * Customer
 * @Serializer\ExclusionPolicy("ALL")
 */
trait CustomerTrait {

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