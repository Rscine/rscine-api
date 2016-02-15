<?php

namespace Rscine\AppBundle\Model\Timestampable;

interface TimestampableInterface
{
    /**
     * Returns the creation date
     *
     * @return DateTime
     */
    public function getCreated();

    /**
     * Returns the last update date
     *
     * @return DateTime
     */
    public function getUpdated();

    /**
     * Sets the creation date
     *
     * @param DateTime $date
     *
     * @return TimestampableInterface
     */
    public function setCreated(DateTime $date);

    /**
     * Sets the last update date
     *
     * @param DateTime $date
     *
     * @return TimestampableInterface
     */
    public function setUpdated(DateTime $date);

}
