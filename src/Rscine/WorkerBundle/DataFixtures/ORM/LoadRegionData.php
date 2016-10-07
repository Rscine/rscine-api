<?php

namespace Rscine\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rscine\WorkerBundle\Entity\Region;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadRegionData implements FixtureInterface, OrderedFixtureInterface {

    private $regionNames = array(
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

        foreach ($this->regionNames as $regionName) {
            $region = new Region();
            $region->setName($regionName);
            $manager->persist($region);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }

}
