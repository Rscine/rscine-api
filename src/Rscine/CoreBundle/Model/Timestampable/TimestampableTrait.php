<?php

namespace Rscine\CoreBundle\Model\Timestampable;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Gedmo\Mapping\Annotation as Gedmo;

trait TimestampableTrait
{
    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Serializer\Expose
     * @Serializer\Type("DateTime<'Y-m-d'>")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Serializer\Expose
     * @Serializer\Type("DateTime<'Y-m-d'>")
     */
    private $updated;

    /**
     * @{inheritdoc}
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @{inheritdoc}
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @{inheritdoc}
     */
    public function setCreated(DateTime $date)
    {
        $this->created = $date;

        return $this;
    }

    /**
     * @{inheritdoc}
     */
    public function setUpdated(DateTime $date)
    {
        $this->updated = $date;

        return $this;
    }
}
