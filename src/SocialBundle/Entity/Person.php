<?php

namespace SocialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

use SocialBundle\Entity\Company;
use SocialBundle\Entity\Worker;


/**
 * Person
 *
 * @ORM\Table()
 * @ORM\Entity()
 *
 * @Serializer\ExclusionPolicy("ALL")
 *
 * @Hateoas\Relation(
 *     "company",
 *     href = @Hateoas\Route("get_company", parameters={"company" = "expr(object.getCompany().getId())"}),
 *     exclusion = @Hateoas\Exclusion(excludeIf = "expr(object.getCompany() === null)"),
 *     attributes = {"id"= "expr(object.getCompany().getId())"}
 * )
 */
class Person extends Worker
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
    protected $id;


    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="employees")
     */
    protected $company;

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
     * Set company
     *
     * @param Company $company
     *
     * @return Person
     */
    public function setCompany(Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}
