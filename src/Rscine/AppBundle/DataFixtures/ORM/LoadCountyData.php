<?php

namespace Rscine\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rscine\AppBundle\Entity\County;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCountyData implements FixtureInterface, OrderedFixtureInterface {

    private $countyNames = array(
        'Languedoc-Roussillon',
        'Normandie',
        'Picardie',
        'Aquitaine'
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->countyNames as $countyName) {
            $county = new County();
            $county->setName($countyName);
            $manager->persist($county);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }

}
