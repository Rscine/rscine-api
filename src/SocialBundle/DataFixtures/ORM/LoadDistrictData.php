<?php

namespace SocialBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SocialBundle\Entity\District;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadDistrictData implements FixtureInterface, OrderedFixtureInterface {

    private $districtNames = array(
        'Hérault' => 34,
        'Gironde' => 33,
        'Lozère' => 48,
        'Pyrénées-Atlantiques' => 64
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->districtNames as $districtName => $districtNumber) {
            $district = new District();
            $district->setName($districtName);
            $district->setNumber($districtNumber);
            $manager->persist($district);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }

}
