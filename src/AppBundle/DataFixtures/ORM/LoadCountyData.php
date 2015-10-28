<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\County;
use AppBundle\AppBundle;

class LoadCountyData implements FixtureInterface {

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

}
